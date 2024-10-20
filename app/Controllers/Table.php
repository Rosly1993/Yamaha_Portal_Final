<?php

namespace App\Controllers;
use App\Models\Auth;
use App\Models\Roles_model;

class Table extends BaseController
{
    protected $request;
    protected $session;
    protected $roles_model;
    protected $auth_model;
    protected $data;
    protected $db; // Declare the $db property

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->roles_model = new Roles_model();
        $this->auth_model = new Auth();
        $this->data = ['session' => $this->session];
        $this->db = \Config\Database::connect(); // Initialize the database connection
    }

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
            'page_name' => 'Users',
            'role_id' => $roles
        ]);

        // Get the result as an array
        $result_area = $query->getRowArray();

        if($daysRemaining < 1){
            // If the password has expired
            $this->data['page_title'] = "Expired";
            return view('pages/changepassword', $this->data);
    
          }elseif(isset($result_area['is_view']) && $result_area['is_view'] == 1){
            $this->data['rolename'] = $this->roles_model->getActiveRoles();
            $this->data['page_title'] = "Table";
            return view('pages/user_table', $this->data);
    
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

    public function add()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'firstname' => 'required',
                'middlename' => 'required',
                'lastname'  => 'required',
                'id_number'  => 'required|is_unique[users.id_number]',
                'password'  => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/]',
                'email'     => 'required|valid_email|is_unique[users.email]',
            ]);
    
            if (!$validation->withRequest($this->request)->run()) {
                return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
            }
    
            // Retrieve form data
            $roleId = $this->request->getPost('role_id');
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

            // Load the session service
            $session = \Config\Services::session();
    
            // Prepare user data
            $userData = [
                'id_number' => $this->request->getPost('id_number'),
                'role_id' => $this->request->getPost('role_id'),
                'firstname' => $this->request->getPost('firstname'),
                'middlename' => $this->request->getPost('middlename'),
                'lastname'  => $this->request->getPost('lastname'),
                'gender' => $this->request->getPost('gender'),
                'date_of_birth' => $this->request->getPost('date_birth'),
                'phone_number' => $this->request->getPost('contact_number'),
                'branch_id' => $indexKey,
                'profile' => 'default_profile.png',
                'is_active' => 1,
                'date_started' => $this->request->getPost('date_started'),
                'last_update_date' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $session->get('login_firstname') . ' ' . $session->get('login_lastname'),
                'username'  => $username,
                'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'email'     => $this->request->getPost('email'),
            ];
    
            // Insert user data
            $this->auth_model->insert($userData);
    
            // Log activity
            $this->logActivity($session->get('login_username'), 'Add New User', $userData);
    
            return $this->response->setJSON(['success' => true]);
        }
    
        return redirect()->back();
    }
    

    public function edit($id)
    {
        $user = $this->auth_model->find($id);
        if ($user) {
            return $this->response->setJSON(['success' => true, 'data' => $user]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'User not found']);
        }
    }

    public function update($id)
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'firstname' => 'required',
                'middlename' => 'required',
                'lastname'  => 'required',
                'username'  => 'required|is_unique[users.username,IndexKey,{id}]',
                'password'  => 'permit_empty|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/]',
                'email'     => 'required|valid_email|is_unique[users.email,IndexKey,{id}]',
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
            }

            $userData = [
                'firstname' => $this->request->getPost('firstname'),
                'middlename' => $this->request->getPost('middlename'),
                'lastname'  => $this->request->getPost('lastname'),
                'username'  => $this->request->getPost('username'),
                'email'     => $this->request->getPost('email'),
            ];

            $password = $this->request->getPost('password');
            if (!empty($password)) {
                $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $this->auth_model->update($id, $userData);

            return $this->response->setJSON(['success' => true]);
        }

        return redirect()->back();
    }
    // public function getUsers()
    // {
    //     $users = $this->auth_model->findAll();
    //     return $this->response->setJSON(['data' => $users]);
    // }

    public function getUsers()
{
    // Load the query builder
    $builder = $this->db->table('users');
    
    // Add left joins
    $builder->select('users.*, tbl_roles.roles, tbl_3sbranch_list.head_office, tbl_3sbranch_list.dealer_name, tbl_location.area');
    $builder->join('tbl_roles', 'users.role_id = tbl_roles.IndexKey', 'left');
    $builder->join('tbl_3sbranch_list', 'users.branch_id = tbl_3sbranch_list.IndexKey', 'left');
    $builder->join('tbl_location', 'tbl_3sbranch_list.location_id = tbl_location.IndexKey', 'left');
    
    // Execute the query
    $users = $builder->get()->getResultArray();
    
    // Return the data as JSON
    return $this->response->setJSON(['data' => $users]);
}

  
    public function activate($id)
    {
        if ($this->request->isAJAX()) {
            $model = new Auth(); // Ensure this is the correct model
    
            try {
                // Update the 'is_active' field to 0 instead of deleting the record
                $result = $model->update($id, ['is_active' => 1]);
    
                if ($result) {
                    $session = session();
                    $this->logActivity($session->get('login_username'), 'Activate User', "User with ID $id has been Activated.");
    
                    return $this->response->setJSON(['success' => true]);
                } else {
                    return $this->response->setJSON(['success' => false, 'message' => 'Update failed']);
                }
            } catch (\Exception $e) {
                return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    
        return redirect()->back();
    }
    

public function deactivate($id)
{
    if ($this->request->isAJAX()) {
        $model = new Auth(); // Ensure this is the correct model

        try {
            // Update the 'is_active' field to 0 instead of deleting the record
            $result = $model->update($id, ['is_active' => 0]);

            if ($result) {
                $session = session();
                $this->logActivity($session->get('login_username'), 'Deactivate User', "User with ID $id has been deactivated.");

                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Update failed']);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    return redirect()->back();
}


public function lock($id)
{
    if ($this->request->isAJAX()) {
        $model = new Auth(); // Ensure this is the correct model

        try {
            // Update the 'is_active' field to 0 instead of deleting the record
            $result = $model->update($id, ['is_locked' => 1]);

            if ($result) {
                $session = session();
                $this->logActivity($session->get('login_username'), 'Lock User', "User with ID $id has been locked.");

                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Update failed']);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    return redirect()->back();
}
public function unlock($id)
{
    if ($this->request->isAJAX()) {
        $model = new Auth(); // Ensure this is the correct model

        try {
            // Update the 'is_active' field to 0 instead of deleting the record
            $result = $model->update($id, ['is_locked' => 0]);

            if ($result) {
                $session = session();
                $this->logActivity($session->get('login_username'), 'Unlock User', "User with ID $id has been unlocked.");

                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Update failed']);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    return redirect()->back();
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

 
}
    
    

