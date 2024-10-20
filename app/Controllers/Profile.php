<?php

namespace App\Controllers;
use App\Models\Profile_model;

class Profile extends BaseController
{
    protected $request;
    protected $session;
    protected $profile_model;
    protected $data;
    protected $db; // Declare the $db property

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->profile_model = new Profile_model();
        $this->data = ['session' => $this->session];
        $this->db = \Config\Database::connect(); // Initialize the database connection
    }
// get drop down  category and model type


    public function index()
    {
        $session = \Config\Services::session();
        $roles = $this->session->get('login_role_id');
        $lastUpdateDate =$session->get('login_last_update_date');

         // Ensure DateTime is used from global namespace
         $lastUpdateDateTime = new \DateTime($lastUpdateDate);
         $expiryDate = clone $lastUpdateDateTime;
         $expiryDate->modify('+90 days');
         $today = new \DateTime();
 
         // Calculate the interval
         $interval = $today->diff($expiryDate);
 
         // Determine the number of days remaining
         $daysRemaining = $today > $expiryDate ? -$interval->days : $interval->days;

          // Get page access from the database using the query builder
        $builder = $this->db->table('tbl_roles_permission');
        $query = $builder->getWhere([
            'page_name' => 'Profile',
            'role_id' => $roles
        ]);

        // Get the result as an array
        $result_area = $query->getRowArray();

        if($daysRemaining < 1){
            // If the password has expired
            $this->data['page_title'] = "Expired";
            return view('pages/changepassword', $this->data);
    
          }elseif(isset($result_area['is_view']) && $result_area['is_view'] == 1){
            // $this->data['userinfo'] = $this->profile_model->getProfile();
            $this->data['page_title'] = "Profile";
            return view('pages/profile', $this->data);
    
            } else {
                // Return the 404 error view if access is not allowed
                return view('errors/html/error_403');
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
             'details' => $details,
             'date_record' => date('Y-m-d H:i:s'),
         ];
     
         $logModel->insert($logData);
     }
 

    
 
}
    
    

