<?php

namespace App\Controllers;
use App\Models\Branchlist_model;

class Branchlist extends BaseController
{
    protected $request;
    protected $session;
    protected $branchlist_model;
    protected $data;
    protected $db; // Declare the $db property

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->branchlist_model = new branchlist_model();
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
            'page_name' => '3s_branchlist',
            'role_id' => $roles
        ]);

        // Get the result as an array
        $result_area = $query->getRowArray();

    if($daysRemaining < 1){
        // If the password has expired
        $this->data['page_title'] = "Expired";
        return view('pages/changepassword', $this->data);

      }elseif(isset($result_area['is_view']) && $result_area['is_view'] == 1){
        
        $this->data['page_title'] = "Branchlist";
        return view('pages/branchlist', $this->data);

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
            'head_office' => 'required',
            'dealer_name' => 'required',
            'dealer_code'  => 'required',
            'shop_type'  => 'required',
            'date_opened'  => 'required',
            'area'  => 'required',
            'region'  => 'required',
            'cluster_province'  => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
        }

      // Get category and model_type values from the request
      $area = strtoupper($this->request->getPost('area'));
      $region = strtoupper($this->request->getPost('region'));
      $cluster_province = strtoupper($this->request->getPost('cluster_province'));

      // Load the LocationModel (assuming you have this model)
      $locationModel = new \App\Models\Location_model();

      // Retrieve the IndexKey from tbl_motorcycle_category
      $indexKey = $locationModel->where('area', $area)
                                          ->where('region', $region)
                                          ->where('cluster_province', $cluster_province)
                                          ->get()
                                          ->getRow('IndexKey');

      if (!$indexKey) {
          return $this->response->setJSON([
              'success' => false,
              'message' => 'Invalid Data.'
          ]);
      }


        // Prepare data for insertion
        $data = [
            'head_office' => strtoupper($this->request->getPost('head_office')),
            'dealer_code' => strtoupper($this->request->getPost('dealer_code')),
            'dealer_name'  => strtoupper($this->request->getPost('dealer_name')),
            'shop_type'  => strtoupper($this->request->getPost('shop_type')),
            'date_opened'  => strtoupper($this->request->getPost('date_opened')),
            'location_id' => $indexKey, // Store the IndexKey as category_id or as needed
        ];

        if ($this->branchlist_model->recordExists($data)) {
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

        $this->branchlist_model->insert($userData);

        // Log activity
        $this->logActivity($session->get('login_username'), 'Add Motorcycle List', $userData);

        return $this->response->setJSON(['success' => true]);
    }

    return redirect()->back();
}



    public function edit($id)
{
    $data = $this->branchlist_model->getBranchlistById($id);
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
                'head_office' => 'required',
                'dealer_code' => 'required',
                'dealer_name'  => 'required',
                'area'  => 'required',
                'region'  => 'required',
                'cluster_province'  => 'required',
            ]);
    
            if (!$validation->withRequest($this->request)->run()) {
                return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
            }

            // Get category and model_type values from the request
            $area = strtoupper($this->request->getPost('area'));
            $region = strtoupper($this->request->getPost('region'));
            $cluster_province = strtoupper($this->request->getPost('cluster_province'));

            // Load the LocationModel (assuming you have this model)
            $locationModel = new \App\Models\Location_model();

            // Retrieve the IndexKey from tbl_motorcycle_category
            $indexKey = $locationModel->where('area', $area)
                                                ->where('region', $region)
                                                ->where('cluster_province', $cluster_province)
                                                ->get()
                                                ->getRow('IndexKey');

            if (!$indexKey) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Invalid Data.'
                ]);
            }
    
            // Load the session service
            $session = \Config\Services::session();
    
            $userData = [
                'head_office' => strtoupper($this->request->getPost('head_office')),
                'dealer_code' => strtoupper($this->request->getPost('dealer_code')),
                'dealer_name'  => strtoupper($this->request->getPost('dealer_name')),
                'location_id' => $indexKey, // Store the IndexKey as category_id or as needed
                'updated_at'   => date('Y-m-d H:i:s'),
                'updated_by'   => $session->get('login_firstname').' '. $session->get('login_lastname'),
            ];
    
            // Debug the data and ID
            log_message('debug', 'Update ID: ' . $id);
            log_message('debug', 'User Data: ' . print_r($userData, true));
    
            // Check if record with same data already exists
            $existingRecord = $this->branchlist_model->update_recordExists($userData, $id);
    
            if ($existingRecord) {
                return $this->response->setJSON(['success' => false, 'error' => 'Record with the same details already exists.']);
            }
    
            $this->branchlist_model->update($id, $userData);

            // Log activity
            $this->logActivity($session->get('login_username'), 'Update 3s Branch List', $userData);
    
            return $this->response->setJSON(['success' => true]);
        }
    
        return redirect()->back();
    }
   
   // if no joining table
    // public function getData()
    // {
    //     $datas = $this->branchlist_model->findAll();
    //     return $this->response->setJSON(['data' => $datas]);
    // }

    public function getData()
    {
        // Fetch data with model type
        $datas = $this->branchlist_model->getDataWithLocation();
        return $this->response->setJSON(['data' => $datas]);
    }
  
    public function activate($id)
    {
        if ($this->request->isAJAX()) {
            $model = new branchlist_model(); // Ensure this is the correct model
    
            try {
                // Retrieve the existing data before updating
                $motorcycleData = $model->find($id);
                if (!$motorcycleData) {
                    return $this->response->setJSON(['success' => false, 'message' => 'Data not found']);
                }
    
                // Update the 'is_active' field to 1
                $result = $model->update($id, ['is_active' => 1]);
    
                if ($result) {
                    // Log the activation action with full details
                    $session = session();
                    $this->logActivity($session->get('login_username'), 'Activate Branch List', $motorcycleData);
    
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
            $model = new branchlist_model(); // Ensure this is the correct model
            
            try {
                // Retrieve the existing data before updating
                $motorcycleData = $model->find($id);
                if (!$motorcycleData) {
                    return $this->response->setJSON(['success' => false, 'message' => 'Data not found']);
                }
    
                // Update the 'is_active' field to 0
                $result = $model->update($id, ['is_active' => 0]);
    
                if ($result) {
                    // Log the deactivation action with full details
                    $session = session();
                    $this->logActivity($session->get('login_username'), 'Deactivate Branch List', $motorcycleData);
    
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
    
    

