<?php

namespace App\Controllers;
use App\Models\Location_model;

class Location extends BaseController
{
    protected $request;
    protected $session;
    protected $location_model;
    protected $data;
    protected $db; // Declare the $db property

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->location_model = new Location_model();
        $this->data = ['session' => $this->session];
        $this->db = \Config\Database::connect(); // Initialize the database connection
    }
// get drop down  category and model type

public function getModelTypes()
{
    $categoryId = $this->request->getGet('category');

    // Load the model
    $model = new \App\Models\location_model();

    // Fetch model types based on category and is_active = 1
    $modelTypes = $model->where('category', $categoryId)
                        ->where('is_active', 1) // Add the is_active filter
                        ->findAll();

    // Prepare data for response
    $data = array_map(function($item) {
        return [
            'id' => $item['IndexKey'], // Ensure 'id' exists in your database schema
            'model_type' => $item['model_type']
        ];
    }, $modelTypes);

    return $this->response->setJSON($data);
}

public function getCategories()
{
    // Load the model for categories
    $categoryModel = new \App\Models\location_model();

    // Fetch distinct categories where is_active = 1
    $builder = $categoryModel->builder();
    $builder->distinct(); // Correctly use DISTINCT in the SQL
    $builder->select('category'); // Correctly use DISTINCT in the SQL
    $builder->where('is_active', 1); // Filter by is_active
    $categories = $builder->get()->getResultArray();

    // Prepare data for response
    $data = array_map(function($item) {
        return [
           
            'category' => $item['category']
        ];
    }, $categories);

    return $this->response->setJSON($data);
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
            'page_name' => 'Location',
            'role_id' => $roles
        ]);

        // Get the result as an array
        $result_area = $query->getRowArray();

        if($daysRemaining < 1){
            // If the password has expired
            $this->data['page_title'] = "Expired";
            return view('pages/changepassword', $this->data);
    
          }elseif(isset($result_area['is_view']) && $result_area['is_view'] == 1){
            
            $this->data['page_title'] = "Location";
            return view('pages/location', $this->data);
    
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
 

     //  for dropdown

     public function getAreas()
{
    // Load the model for categories
    $locationModel = new \App\Models\Location_model();

    // Fetch distinct categories where is_active = 1
    $builder = $locationModel->builder();
    $builder->distinct(); // Correctly use DISTINCT in the SQL
    $builder->select('area'); // Correctly use DISTINCT in the SQL
    $builder->where('is_active', 1); // Filter by is_active
    $areas = $builder->get()->getResultArray();

    // Prepare data for response
    $data = array_map(function($item) {
        return [
           
            'area' => $item['area']
        ];
    }, $areas);

    return $this->response->setJSON($data);
}

public function getRegion()
{
    $areaId = $this->request->getGet('area');

    // Load the model getClusterProvince
    $model = new \App\Models\Location_model();

    // Fetch model types based on category and is_active = 1
    $Region = $model->where('area', $areaId)
                        ->where('is_active', 1) // Add the is_active filter
                        ->findAll();

    // Prepare data for response
    $data = array_map(function($item) {
        return [
            'id' => $item['IndexKey'], // Ensure 'id' exists in your database schema
            'region' => $item['region']
        ];
    }, $Region);

    return $this->response->setJSON($data);
}
public function getClusterProvince()
{
    $regionId = $this->request->getGet('region');

    // Load the model 
    $model = new \App\Models\Location_model();

    // Fetch model types based on category and is_active = 1
    $modelTypes = $model->where('region', $regionId)
                        ->where('is_active', 1) // Add the is_active filter
                        ->findAll();

    // Prepare data for response
    $data = array_map(function($item) {
        return [
            'id' => $item['IndexKey'], // Ensure 'id' exists in your database schema
            'cluster_province' => $item['cluster_province']
        ];
    }, $modelTypes);

    return $this->response->setJSON($data);
}

    public function add()
    {
    if ($this->request->isAJAX()) {
        $validation = \Config\Services::validation();
        $validation->setRules([
    
            'area'  => 'required',
            'region'  => 'required',
            'cluster_province'  => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
        }

        $data = [
           
           'area'  => strtoupper($this->request->getPost('area')),
           'region'    => strtoupper($this->request->getPost('region')),
           'cluster_province'    => strtoupper($this->request->getPost('cluster_province')),
        ];

        if ($this->location_model->recordExists($data)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Record already exists'
            ]);
        }
        // Load the session service
        $session = \Config\Services::session();
            
        $userData = array_merge($data, [
            'is_active'  => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'created_by'  => $session->get('login_firstname').' '. $session->get('login_lastname'),
        ]);

        $this->location_model->insert($userData);

        // Log activity
        $this->logActivity($session->get('login_username'), 'Add Location', $userData);

        return $this->response->setJSON(['success' => true]);
    }

    return redirect()->back();
}



    public function edit($id)
    {
        $data = $this->location_model->find($id);
        if ($data) {
            return $this->response->setJSON(['success' => true, 'data' => $data]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Data not found']);
        }
    }

    public function update($id)
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'area'  => 'required',
                'region'  => 'required',
                'cluster_province'  => 'required',
            ]);
    
            if (!$validation->withRequest($this->request)->run()) {
                return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
            }
    
            // Load the session service
            $session = \Config\Services::session();
    
            $userData = [
                'area'  => strtoupper($this->request->getPost('area')),
                'region'     => strtoupper($this->request->getPost('region')),
                'cluster_province'     => strtoupper($this->request->getPost('cluster_province')),
                'updated_at'   => date('Y-m-d H:i:s'),
                'updated_by'   => $session->get('login_firstname').' '. $session->get('login_lastname'),
            ];
    
            // Debug the data and ID
            log_message('debug', 'Update ID: ' . $id);
            log_message('debug', 'User Data: ' . print_r($userData, true));
    
            // Check if record with same data already exists
            $existingRecord = $this->location_model->update_recordExists($userData, $id);
    
            if ($existingRecord) {
                return $this->response->setJSON(['success' => false, 'error' => 'Record with the same details already exists.']);
            }
    
            $this->location_model->update($id, $userData);

            // Log activity
            $this->logActivity($session->get('login_username'), 'Update Location', $userData);
    
            return $this->response->setJSON(['success' => true]);
        }
    
        return redirect()->back();
    }
   
    
    public function getData()
    {
        $datas = $this->location_model
        ->where('is_active', 1)
        ->findAll();
        return $this->response->setJSON(['data' => $datas]);
    }
  
    public function activate($id)
    {
        if ($this->request->isAJAX()) {
            $model = new location_model(); // Ensure this is the correct model
    
            try {
                // Retrieve the existing data before updating
                $locationData = $model->find($id);
                if (!$locationData) {
                    return $this->response->setJSON(['success' => false, 'message' => 'Data not found']);
                }
    
                // Update the 'is_active' field to 1
                $result = $model->update($id, ['is_active' => 1]);
    
                if ($result) {
                    // Log the activation action with full details
                    $session = session();
                    $this->logActivity($session->get('login_username'), 'Activate Location', $locationData);
    
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
            $model = new location_model(); // Ensure this is the correct model
            
            try {
                // Retrieve the existing data before updating
                $locationData = $model->find($id);
                if (!$locationData) {
                    return $this->response->setJSON(['success' => false, 'message' => 'Data not found']);
                }
    
                // Update the 'is_active' field to 0
                $result = $model->update($id, ['is_active' => 0]);
    
                if ($result) {
                    // Log the deactivation action with full details
                    $session = session();
                    $this->logActivity($session->get('login_username'), 'Deactivate Location', $locationData);
    
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
    
   
 
}
    
    

