<?php

namespace App\Controllers;
use App\Models\Roles_model;
use App\Controllers\BaseController;
use App\Models\LoginModel;

class LoginController extends BaseController
{
    protected $request;
    protected $loginModel;
    protected $roles_model;
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->roles_model = new Roles_model();
        $this->loginModel = new LoginModel;
    }
   

    public function index()
    {
        $data = [];
        $data['page_title'] = "Login";
        $session = session();
    
        if ($this->request->getMethod() == 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            // $rememberMe = $this->request->getPost('remember'); // Get "Remember Me" checkbox value
            $user = $this->loginModel->where('username', $username)->first();

            // if ($rememberMe) {
            //     // If "Remember Me" is checked, set a cookie for username and token
            //     $this->setRememberMe($user['IndexKey']); // Assuming 'IndexKey' is your primary key
            // }
    
            if ($user) {
                // Check if the account is locked
                if ($user['is_locked'] == 1) {
                    // Account is locked, don't allow login
                    $session->setFlashdata('error', 'Your account is locked due to too many failed login attempts. Please contact the administrator.');
                    return redirect()->to('/');
                }
    
                // If the account is not locked, proceed
                if ($user['is_active'] == 1) {
                    $verify_password = password_verify($password, $user['password']);
                    
                    if ($verify_password) {
                        // Reset login_attempt_count and unlock account on successful login
                        $this->loginModel->update($user['IndexKey'], [
                            'last_login_date' => date('Y-m-d H:i:s'),
                            'login_attempt_count' => 0, // Reset attempt count
                            'is_locked' => 0 // Unlock account
                        ]);
    
                        // Log successful login
                        $this->logActivity($username, 'Login', 'Successful login.');
    
                        // Set session data
                        foreach ($user as $k => $v) {
                            $session->set('login_'.$k, $v);
                        }
    
                        return redirect()->to('/Main');
                    } else {
                        // Increment login_attempt_count on incorrect password
                        $attempts = $user['login_attempt_count'] + 1;
    
                        // Update login attempt count in the database
                        $this->loginModel->update($user['IndexKey'], [
                            'login_attempt_count' => $attempts
                        ]);
    
                        if ($attempts >= 5) {
                            // Lock account after 5 failed attempts
                            $this->loginModel->update($user['IndexKey'], [
                                'is_locked' => 1 // Lock the account
                            ]);
                            $session->setFlashdata('error', 'Your account has been locked due to too many failed login attempts. Please contact the administrator.');
                            $this->logActivity($username, 'Login', 'Account locked after 5 failed login attempts.');
                        } else {
                            // Log failed login due to incorrect password
                            $this->logActivity($username, 'Login', 'Failed login - Incorrect password.');
                            $session->setFlashdata('error', 'Incorrect Password. Attempt ' . $attempts . ' of 5.');
                        }
                    }
                } else {
                    // Log failed login due to inactive account
                    $this->logActivity($username, 'Login', 'Failed login - Account inactive.');
                    $session->setFlashdata('error', 'Your account is inactive. Please contact the administrator.');
                }
            } else {
                // Log failed login due to non-existent username
                $this->logActivity($username, 'Login', 'Failed login - Username not found.');
                $session->setFlashdata('error', 'Incorrect Username or Password');
            }
        }
    
        $data['session'] = $session;
        return view('login/login', $data);
    }
    
    
    
    private function logActivity($username, $activity, $details)
    {
        $logModel = new \App\Models\LogModel();
    
        // Get the IP address of the user
        $ip_address = $this->request->getIPAddress();
         // Convert IPv6 loopback address (::1) to IPv4 loopback (127.0.0.1)
            if ($ip_address == '::1') {
                $ip_address = '127.0.0.1';
            }
    
        $data = [
            'username' => $username,
            'activity' => $activity,
            'details' => $details,
            'ip_address' => $ip_address, // Log the IP address
            'date_record' => date('Y-m-d H:i:s'),
        ];
    
        $logModel->insert($data);
    }
    
public function logout()
{
    $session = session();
    $username = $session->get('login_username');
    
    // Log the logout action
    $this->logActivity($username, 'Logout', 'User logged out.');

    $session->destroy();
    return redirect()->to('/');
}

    public function registration(){
        $session = session();
        $data=[];
        $data['session'] = $session;
        $data['rolename'] = $this->roles_model->getActiveRoles();
        $data['data'] = $this->request;
        $data['page_title'] = "Registraion";
        if($this->request->getMethod() == 'post'){
            $firstname = $this->request->getPost('firstname');
            $middlename =$this->request->getPost('middlename');
            $lastname = $this->request->getPost('lastname');
            $gender = $this->request->getPost('gender');
            $date_birth = $this->request->getPost('date_birth');
            $id_number = $this->request->getPost('id_number');
            $phone_number = $this->request->getPost('phone_number');
            $roleId = $this->request->getPost('role_id');
            $email = $this->request->getPost('email');

             // Retrieve form data
             $headoffice = $this->request->getPost('headoffice');
             $branchname = $this->request->getPost('branchname');
             $area = $this->request->getPost('area');

            // Load the MotorcycleListModel (assuming you have this model)
            $motorcycleListModel = new \App\Models\Branchlist_model();
                
            // Retrieve the IndexKey from tbl_motorcycle_category
            $indexKey = $motorcycleListModel->where('head_office', $headoffice)
                                            ->where('dealer_name', $branchname)
                                            ->where('location_id', $area)
                                            ->get()
                                            ->getRow('IndexKey');

            if (!$indexKey) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Invalid ID.'
                ]);
            }



             // Generate username based on role_id
            $username = $this->request->getPost('id_number'); // Default username

            if ($roleId == 5) {
                $rolesModel = new \App\Models\Roles_model(); // Assuming you have a RolesModel
                $latestUser = $rolesModel->select('latest_usernumber')
                                        ->where('IndexKey', 5)
                                        ->orderBy('created_at', 'DESC')
                                        ->first();

                if ($latestUser && !empty($latestUser['latest_usernumber'])) {
                    $lastNumber = (int) substr($latestUser['latest_usernumber'], 4); // Extract the digits after 'YTA-'
                    $newNumber = $lastNumber + 1;
                    $username = 'YTA-' . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
                } else {
                    $newNumber = 1; // Starting number
                    $username = 'YTA-000001'; // If no latest_usernumber is found, start with YTA-000001
                }

                // Update latest_usernumber in the roles table
                $rolesModel->set('latest_usernumber', $username)
                        ->where('IndexKey', 5)
                        ->update();
            } else {
                // If role_id is not 5, use id_number as the username
                $username = $this->request->getPost('id_number');
            }

            $checkIdnumber = $this->loginModel->where('id_number', $id_number)->countAllResults();
            if($checkIdnumber > 0){
                $session->setFlashdata('error','ID Number is already taken, Please verify to admin');
            }else{
                $idata = [  
                            'firstname' => $firstname,
                            'middlename' => $middlename,
                            'lastname' => $lastname,
                            'username' => $username,
                            'gender' => $gender,
                            'date_of_birth' => $date_birth,
                            'id_number' => $id_number,
                            'phone_number' => $phone_number,
                            'branch_id' => $indexKey,
                            'role_id' => $roleId,
                            'email' => $email,
                            'is_active' => 0,
                            'is_locked' => 0,
                            'password_status' => 0,//temporary
                            'created_at' => date('Y-m-d H:i'),
                            'last_update_date' => date('Y-m-d H:i'),
                            'profile' => 'default_profile.png',
                            'password' =>password_hash($username, PASSWORD_DEFAULT),
                           
                            
                        ];
                $save = $this->loginModel->save($idata);
                if($save){
                    $session->setFlashdata('success','Your Account has been registered sucessfully, Please contact admin for the activation of your account.');
                    $this->logActivity($username, 'Signup', 'Successfully signup ');
                    return redirect()->to('/');
                }
            }
        }
        return view('login/registration', $data);
    }
      //  for dropdown

  public function getHeadoffice()
  {
      // Load the model for categories
      $branchlistModel = new \App\Models\Branchlist_model();
  
      // Fetch distinct categories where is_active = 1
      $builder = $branchlistModel->builder();
      $builder->distinct(); // Correctly use DISTINCT in the SQL
      $builder->select('head_office'); // Correctly use DISTINCT in the SQL
      $builder->where('is_active', 1); // Filter by is_active
      $headoffice = $builder->get()->getResultArray();
  
      // Prepare data for response
      $data = array_map(function($item) {
          return [
             
              'head_office' => $item['head_office']
          ];
      }, $headoffice);
  
      return $this->response->setJSON($data);
  }
  
  public function getBranchname()
  {
      $head_officeId = $this->request->getGet('headoffice');
  
      // Load the model getClusterProvince
      $model = new \App\Models\Branchlist_model();
  
      // Fetch model types based on category and is_active = 1
      $Branchname = $model->where('head_office', $head_officeId)
                          ->where('is_active', 1) // Add the is_active filter
                          ->findAll();
  
      // Prepare data for response
      $data = array_map(function($item) {
          return [
              'id' => $item['IndexKey'], // Ensure 'id' exists in your database schema
              'dealer_name' => $item['dealer_name']
          ];
      }, $Branchname);
  
      return $this->response->setJSON($data);
  }


public function getArea()
{
    $branchnameId = $this->request->getGet('branchname');

    // Load the model 
    $model = new \App\Models\Branchlist_model();

    // Perform the left join to fetch IndexKey and area based on the dealer_name and is_active conditions
    $results = $model->select('tbl_3sbranch_list.location_id,tbl_3sbranch_list.IndexKey, tbl_location.area')
                     ->join('tbl_location', 'tbl_3sbranch_list.location_id = tbl_location.IndexKey', 'left')
                     ->where('tbl_3sbranch_list.dealer_name', $branchnameId)
                     ->where('tbl_3sbranch_list.is_active', 1)
                     ->findAll();

    // Prepare data for response
    $data = array_map(function($item) {
        return [
            'id' => $item['IndexKey'],  // 'IndexKey' from tbl_3sbranch_list
            'area' => $item['area'],    // 'area' from tbl_location
            'location_id' => $item['location_id']     // 'area' from tbl_location
        ];
    }, $results);

    return $this->response->setJSON($data);
}
public function request_otp() {
    $session = session();
    $data = [];
    $data['session'] = $session;
    $data['rolename'] = $this->roles_model->getActiveRoles();
    $data['data'] = $this->request;
    $data['page_title'] = "Request otp";

    if ($this->request->getMethod() == 'post') {
        $email = $this->request->getPost('email');
        $id_number = $this->request->getPost('id_number');

        $username=$id_number;
        
        // Check if the email exists in the database
        $user = $this->loginModel->where('email', $email)
        ->where('id_number', $id_number)
        ->first();

        if ($user) {
            // Email exists, generate a new OTP
            $otp = rand(100000, 999999);
            
            // Prepare data for updating the OTP
            $idata = [
                'otp' => $otp
            ];

            // Update OTP where the email and id_number match
            $update = $this->loginModel->where('email', $email)
                                       ->where('id_number', $id_number)
                                       ->set($idata)
                                       ->update();
            
            if ($update) {
                $session->setFlashdata('success', 'We\'ve sent an OTP to your email address to reset your password!');
                $this->logActivity($username, 'Request OTP', 'Successfully sent OTP to ' . $email);

                return redirect()->to('/reset_password');
            } else {
                $session->setFlashdata('error', 'Failed to update OTP. Please try again.');
            }
        } else {
            // Email not found
            $session->setFlashdata('error', 'Email and Id Number not match in the database.');
        }
    }

    return view('login/request_otp', $data);
}


public function reset_password() {
    $session = session();
    $data = [];
    $data['session'] = $session;
    $data['data'] = $this->request;
    $data['page_title'] = "Reset Password";

    if ($this->request->getMethod() == 'post') {
        $otp = $this->request->getPost('otp');
        $newPassword = $this->request->getPost('new-password');

        // Check if the OTP exists in the database
        $user = $this->loginModel->where('otp', $otp)->first();

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
                    $session->setFlashdata('error', 'Password recently used, please choose another password');
                    return redirect()->back(); // Redirect back to the form
                }
            }

            // Hash the new password and update it
            $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $user['password2'] = $user['password1'] ?? ''; // Move the current password to password2
            $user['password1'] = $user['password'] ?? ''; // Move password1 to password1
            $user['password'] = $newPasswordHash; // Set new password
            $user['last_update_date'] = date('Y-m-d H:i:s'); 
            $user['otp'] = null; // Set OTP to null
            $user['is_locked'] = 0; // Set OTP to null
            $user['login_attempt_count'] = 0; // Set OTP to null

            // Save the updated user data
            $update = $this->loginModel->save($user);

            if ($update) {
                $session->setFlashdata('success', 'Successfully Reset Password!');
                $this->logActivity($user['username'], 'Reset Password', 'Successfully Reset Password'); // Assuming email is used as username

                return redirect()->to('/');
            } else {
                $session->setFlashdata('error', 'Failed to update password. Please try again.');
            }
        } else {
            // OTP not found
            $session->setFlashdata('error', 'OTP not found in the database.');
        }
    }

    return view('login/reset_password', $data);
}
}


