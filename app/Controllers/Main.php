<?php

namespace App\Controllers;
use App\Models\Servicemanuals_model;
use App\Models\Servicebulletins_model;
use App\Models\Auth;


class Main extends BaseController
{   
    protected $request;
    protected $session;
    protected $serviceManualModel;
    protected $serviceBulletinModel;
    protected $authModel;
    protected $data;
    protected $db; // Declare the $db property

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->serviceManualModel = new Servicemanuals_model();
        $this->serviceBulletinModel = new Servicebulletins_model();
        $this->authModel = new Auth();
        $this->data = ['session' => $this->session];
        $this->db = \Config\Database::connect(); // Initialize the database connection
    }

    public function index()
    {
        // Load the session service
        $session = \Config\Services::session();
    
        // Retrieve the last update date from the session
        $lastUpdateDate = $session->get('login_last_update_date');
    
        if (!$lastUpdateDate) {
            // Handle the case where the last update date is not set in the session
            $this->data['page_title'] = "Error";
            $this->data['error_message'] = "Last update date not set in session.";
            return view('pages/error', $this->data);
        }
    
        try {
            // Ensure DateTime is used from global namespace
            $lastUpdateDateTime = new \DateTime($lastUpdateDate);
            $expiryDate = clone $lastUpdateDateTime;
            $expiryDate->modify('+90 days');
            $today = new \DateTime();
    
            // Calculate the interval
            $interval = $today->diff($expiryDate);
    
            // Determine the number of days remaining
            $daysRemaining = $today > $expiryDate ? -$interval->days : $interval->days;
    
            if ($daysRemaining < 1) {
                // If the password has expired
                $this->data['page_title'] = "Expired";
                return view('pages/changepassword', $this->data);
            } else {
                // If the password has not expired
                $this->data['page_title'] = "Home";
                $this->data['manual_count'] = $this->serviceManualModel->countCurrentMonthYear();
                $this->data['bulletin_count'] = $this->serviceBulletinModel->countCurrentMonthYear();
                return view('pages/home', $this->data);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            $this->data['page_title'] = "Error";
            $this->data['error_message'] = "An error occurred: " . $e->getMessage();
            return view('pages/error', $this->data);
        }
    }
     // for Audit Trail
     private function logActivity($username, $activity, $data)
     {
         $logModel = new \App\Models\LogModel();
         $details = json_encode($data); // Convert data array to JSON string

         // Get the IP address of the user
        $ip_address = $this->request->getIPAddress();
        // Convert IPv6 loopback address (::1) to IPv4 loopback (127.0.0.1)
           if ($ip_address == '::1') {
               $ip_address = '127.0.0.1';
           }
     
         $logData = [
             'username' => $username,
             'activity' => $activity,
             'ip_address' => $ip_address, // Log the IP address
             'details' => 'Changed Successfully',
             'date_record' => date('Y-m-d H:i:s'),
         ];
     
         $logModel->insert($logData);
     }
 

  
public function changepassword()
{
    // Load the session service
    $session = \Config\Services::session();

    // Get form data
    $newPassword = $this->request->getPost('new-password');

    // Load the Auth model
    $userModel = new \App\Models\Auth();

    // Find the user by session login_IndexKey
    $user = $userModel->find(session()->get('login_IndexKey'));

    if ($user) {
        // Initialize old password fields if they are not set
        $oldPasswords = [
            $user['password'] ?? '', 
            $user['password1'] ?? '', 
            $user['password2'] ?? ''
        ];

        // Check if the new password matches any of the old ones
        foreach ($oldPasswords as $oldPassword) {
            if (!empty($oldPassword) && password_verify($newPassword, $oldPassword)) {
                // Password is recently used
                session()->setFlashdata('error', 'Password recently used, please choose another password');
                return redirect()->back(); // Redirect back to the form
            }
        }

        // Hash the new password and update it
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $user['password2'] = $user['password1'] ?? ''; // Move the current password to password2
        $user['password1'] = $user['password'] ?? ''; // Move password1 to password1
        $user['password'] = $newPasswordHash; // Set new password
        $user['last_update_date'] = date('Y-m-d H:i:s'); 
        // Save the updated user data
        $userModel->save($user);

        // Set success message and redirect
        session()->setFlashdata('success', 'Password changed successfully');
        // Log activity
        $this->logActivity($session->get('login_username'), 'Change Password', $user);
        $this->data['page_title'] = "Expired";
        return view('pages/changepassword', $this->data);
    } else {
        // Handle case where user is not found
        session()->setFlashdata('error', 'User not found');
        return redirect()->back(); // Redirect back to the form
    }
}


public function logout()
{
    // Destroy session and redirect to login page
    session()->destroy();
    return redirect()->to('/');
}
}

