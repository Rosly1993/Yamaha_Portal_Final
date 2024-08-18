<?php

namespace App\Controllers;
use App\Models\Motorcyclelist_model;

class Motorcyclelist extends BaseController
{
    protected $request;
    protected $session;
    protected $motorcyclelist_model;
    protected $data;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->motorcyclelist_model = new Motorcyclelist_model();
        $this->data = ['session' => $this->session];
    }

    public function index()
    {

        $this->data['page_title'] = "Motorcyclelist";
        return view('pages/motorcyclelist', $this->data);
    }
     // for Audit Trail
     private function logActivity($username, $activity, $data)
     {
         $logModel = new \App\Models\LogModel();
         $details = json_encode($data); // Convert data array to JSON string
     
         $logData = [
             'username' => $username,
             'activity' => $activity,
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
            'pet_name' => 'required',
            'model_code' => 'required',
            'model_name'  => 'required',
            'model_type'  => 'required',
            'category'  => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
        }

        $data = [
            'pet_name'   => strtoupper($this->request->getPost('pet_name')),
            'model_code' => strtoupper($this->request->getPost('model_code')),
            'model_name' => strtoupper($this->request->getPost('model_name')),
            'model_type' => strtoupper($this->request->getPost('model_type')),
            'category'   => strtoupper($this->request->getPost('category')),
        ];

        if ($this->motorcyclelist_model->recordExists($data)) {
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

        $this->motorcyclelist_model->insert($userData);

        // Log activity
        $this->logActivity($session->get('login_username'), 'Add Motorcycle List', $userData);

        return $this->response->setJSON(['success' => true]);
    }

    return redirect()->back();
}



    public function edit($id)
    {
        $data = $this->motorcyclelist_model->find($id);
        if ($data) {
            return $this->response->setJSON(['success' => true, 'data' => $data]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Data not found']);
        }
    }

//     public function edit($id)
// {
//     $motorcycle = $this->motorcyclelist_model->find($id);
    
//     if ($motorcycle) {
//         // Fetch categories and model types
//         $categoryModel = new \App\Models\Motorcyclecategory_model(); // Ensure this model exists and is loaded
//         $categories = $categoryModel->findAll();
        
//         $modelTypeModel = new \App\Models\Motorcyclecategory_model(); // Ensure this model exists and is loaded
//         $modelTypes = $modelTypeModel->findAll();
        
//         return $this->response->setJSON([
//             'success' => true,
//             'data' => $motorcycle,
//             'categories' => $categories,
//             'modelTypes' => $modelTypes
//         ]);
//     } else {
//         return $this->response->setJSON(['success' => false, 'message' => 'Data not found']);
//     }
// }


    public function update($id)
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'pet_name' => 'required',
                'model_code' => 'required',
                'model_name'  => 'required',
                'model_type'  => 'required',
                'category'  => 'required',
            ]);
    
            if (!$validation->withRequest($this->request)->run()) {
                return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
            }
    
            // Load the session service
            $session = \Config\Services::session();
    
            $userData = [
                'pet_name' => strtoupper($this->request->getPost('pet_name')),
                'model_code' => strtoupper($this->request->getPost('model_code')),
                'model_name'  => strtoupper($this->request->getPost('model_name')),
                'model_type'  => strtoupper($this->request->getPost('model_type')),
                'category'     => strtoupper($this->request->getPost('category')),
                'updated_at'   => date('Y-m-d H:i:s'),
                'updated_by'   => $session->get('login_firstname').' '. $session->get('login_lastname'),
            ];
    
            // Debug the data and ID
            log_message('debug', 'Update ID: ' . $id);
            log_message('debug', 'User Data: ' . print_r($userData, true));
    
            // Check if record with same data already exists
            $existingRecord = $this->motorcyclelist_model->update_recordExists($userData, $id);
    
            if ($existingRecord) {
                return $this->response->setJSON(['success' => false, 'error' => 'Record with the same details already exists.']);
            }
    
            $this->motorcyclelist_model->update($id, $userData);

            // Log activity
            $this->logActivity($session->get('login_username'), 'Update Motorcycle List', $userData);
    
            return $this->response->setJSON(['success' => true]);
        }
    
        return redirect()->back();
    }
   
   // if no joining table
    // public function getData()
    // {
    //     $datas = $this->motorcyclelist_model->findAll();
    //     return $this->response->setJSON(['data' => $datas]);
    // }

    public function getData()
    {
        // Fetch data with model type
        $datas = $this->motorcyclelist_model->getDataWithModelType();
        return $this->response->setJSON(['data' => $datas]);
    }
  
    public function activate($id)
    {
        if ($this->request->isAJAX()) {
            $model = new Motorcyclelist_model(); // Ensure this is the correct model
    
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
                    $this->logActivity($session->get('login_username'), 'Activate Motorcycle List', $motorcycleData);
    
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
            $model = new Motorcyclelist_model(); // Ensure this is the correct model
            
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
                    $this->logActivity($session->get('login_username'), 'Deactivate Motorcycle List', $motorcycleData);
    
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
    
    

