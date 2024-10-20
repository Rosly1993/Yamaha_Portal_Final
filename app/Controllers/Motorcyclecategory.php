<?php

namespace App\Controllers;
use App\Models\Motorcyclecategory_model;

class Motorcyclecategory extends BaseController
{
    protected $request;
    protected $session;
    protected $motorcyclecategory_model;
    protected $data;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->motorcyclecategory_model = new Motorcyclecategory_model();
        $this->data = ['session' => $this->session];
    }
// get drop down  category and model type

public function getModelTypes()
{
    $categoryId = $this->request->getGet('category');

    // Load the model
    $model = new \App\Models\Motorcyclecategory_model();

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
    $categoryModel = new \App\Models\Motorcyclecategory_model();

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
        $this->data['page_title'] = "Motorcyclecategory";
        return view('pages/motorcyclecategory', $this->data);
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
    
            'model_type'  => 'required',
            'category'  => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
        }

        $data = [
           
           'model_type'  => strtoupper($this->request->getPost('model_type')),
           'category'    => strtoupper($this->request->getPost('category')),
        ];

        if ($this->motorcyclecategory_model->recordExists($data)) {
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

        $this->motorcyclecategory_model->insert($userData);

        // Log activity
        $this->logActivity($session->get('login_username'), 'Add Motorcycle Category', $userData);

        return $this->response->setJSON(['success' => true]);
    }

    return redirect()->back();
}



    public function edit($id)
    {
        $data = $this->motorcyclecategory_model->find($id);
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
                'model_type'  => 'required',
                'category'  => 'required',
            ]);
    
            if (!$validation->withRequest($this->request)->run()) {
                return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
            }
    
            // Load the session service
            $session = \Config\Services::session();
    
            $userData = [
                'model_type'  => strtoupper($this->request->getPost('model_type')),
                'category'     => strtoupper($this->request->getPost('category')),
                'updated_at'   => date('Y-m-d H:i:s'),
                'updated_by'   => $session->get('login_firstname').' '. $session->get('login_lastname'),
            ];
    
            // Debug the data and ID
            log_message('debug', 'Update ID: ' . $id);
            log_message('debug', 'User Data: ' . print_r($userData, true));
    
            // Check if record with same data already exists
            $existingRecord = $this->motorcyclecategory_model->update_recordExists($userData, $id);
    
            if ($existingRecord) {
                return $this->response->setJSON(['success' => false, 'error' => 'Record with the same details already exists.']);
            }
    
            $this->motorcyclecategory_model->update($id, $userData);

            // Log activity
            $this->logActivity($session->get('login_username'), 'Update Motorcycle Category', $userData);
    
            return $this->response->setJSON(['success' => true]);
        }
    
        return redirect()->back();
    }
   
    
    public function getData()
{
    // Fetch data where is_active = 1
    $datas = $this->motorcyclecategory_model
                  ->where('is_active', 1)
                  ->findAll();

    // Return the data as JSON
    return $this->response->setJSON(['data' => $datas]);
}

  
    public function activate($id)
    {
        if ($this->request->isAJAX()) {
            $model = new Motorcyclecategory_model(); // Ensure this is the correct model
    
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
                    $this->logActivity($session->get('login_username'), 'Activate Motorcycle Category', $motorcycleData);
    
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
            $model = new Motorcyclecategory_model(); // Ensure this is the correct model
            
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
                    $this->logActivity($session->get('login_username'), 'Deactivate Motorcycle Category', $motorcycleData);
    
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
    
    

