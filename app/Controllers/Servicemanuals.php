<?php

namespace App\Controllers;
require_once ROOTPATH . 'public/FPDF/fpdf.php'; // Ensure the path is correct
require_once ROOTPATH . 'public/FPDI/src/autoload.php'; // Ensure the path is correct

use App\Models\Servicemanuals_model;
use setasign\Fpdi\Fpdi;

class Servicemanuals extends BaseController
{
    protected $request;
    protected $session;
    protected $servicemanuals_model;
    protected $data;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->servicemanuals_model = new servicemanuals_model();
        $this->data = ['session' => $this->session];
    }
// get drop down  category and model type
public function getModelcodes()
{
    $ModelId = $this->request->getGet('model_name'); // Make sure this matches JavaScript

    // Load the model
    $model = new \App\Models\Motorcyclelist_model();
    $modelcodes = $model->where('model_name', $ModelId)
                        ->where('is_active', 1)
                        ->findAll();

    // Prepare data for response
    $data = array_map(function($item) {
        return [
            'id' => $item['IndexKey'],
            'model_code' => $item['model_code']
        ];
    }, $modelcodes);

    return $this->response->setJSON($data);
}


public function getModelnames()
{
    $categoryModel = new \App\Models\Motorcyclelist_model();
    $builder = $categoryModel->builder();
    $builder->distinct();
    $builder->select('model_name');
    $builder->where('is_active', 1);
    $categories = $builder->get()->getResultArray();

    $data = array_map(function($item) {
        return ['model_name' => $item['model_name']];
    }, $categories);

    return $this->response->setJSON($data);
}


    public function index()
    {
        $this->data['page_title'] = "Servicemanuals";
        return view('pages/servicemanuals', $this->data);
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
                 'model_name'  => 'required',
                 'model_code'  => 'required',
                
             ]);
     
             if (!$validation->withRequest($this->request)->run()) {
                 return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
             }
            // Get Model Code and Model Name from tbl_motorcycle_list

            $model_name = strtoupper($this->request->getPost('model_name'));
            $model_code = strtoupper($this->request->getPost('model_code'));

            // Load the MotorcycleListModel (assuming you have this model)
            $motorcycleListModel = new \App\Models\Motorcyclelist_model();

            // Retrieve the IndexKey from tbl_motorcycle_category
            $indexKey = $motorcycleListModel->where('model_name', $model_name)
                                                ->where('model_code', $model_code)
                                                ->get()
                                                ->getRow('IndexKey');

            if (!$indexKey) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Invalid model name or model code.'
                ]);
            }



             
            // Handle file upload
            $file = $this->request->getFile('attachment');
            $fileName = $file->getRandomName();
            $filePath = ROOTPATH . 'public/assets/uploads/'; // Update path to public/assets/uploads

            if ($file->isValid() && !$file->hasMoved()) {
                $file->move($filePath, $fileName);
            } else {
                return $this->response->setJSON(['success' => false, 'errors' => ['attachment' => 'File upload failed']]);
            }

     
             $data = [
                 'motorcycle_id' => $indexKey, // Store the IndexKey as category_id or as needed
                 'year_published'       => $this->request->getPost('year_published'),
                 'attachment' => $fileName, // Store the file name in the database
                 'is_confidential'   => 1,
             ];

             
            // Add watermark if the bulletin is confidential
            if ($data['is_confidential'] == 1) {
                $this->addWatermark($filePath . $fileName);
            }

     
             if ($this->servicemanuals_model->recordExists(
                 $data['motorcycle_id'],
                 $data['year_published']
             )) {
                 return $this->response->setJSON([
                     'success' => false,
                     'message' => 'Record already exists'
                 ]);
             }
     



             // Load the session service
             $session = \Config\Services::session();
                 
             $userData = array_merge($data, [
                 'is_active'  => 1,
                 'created_at' => date('Y-m-d H:i:s'),
                 'created_by' => $session->get('login_firstname').' '. $session->get('login_lastname'),
             ]);
     
             $this->servicemanuals_model->insert($userData);
     
             // Log activity
             $this->logActivity($session->get('login_username'), 'Add Service Manuals', $userData);
     
             return $this->response->setJSON(['success' => true]);
         }
     
         return redirect()->back();
     }
     
     private function addWatermark($pdfFilePath)
     {
         $outputFilePath = $pdfFilePath; // Overwrite the original file
     
         $pdf = new class extends Fpdi {
             public function Rotate($angle, $x = '', $y = '') {
                 if ($x === '') {
                     $x = $this->GetX();
                 }
                 if ($y === '') {
                     $y = $this->GetY();
                 }
                 $this->_out('q');
                 $this->_out('1 0 0 1 ' . $x . ' ' . $y . ' cm');
                 $this->_out(sprintf('%.2f 0 0 %.2f 0 0 cm', cos($angle * M_PI / 180), sin($angle * M_PI / 180)));
                 $this->_out(sprintf('0 0 1 0 %.2f %.2f cm', -$x, -$y));
             }
         };
     
         // Get the total number of pages
         $pageCount = $pdf->setSourceFile($pdfFilePath);
     
         for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
             $tplIdx = $pdf->importPage($pageNumber);
             $size = $pdf->getTemplateSize($tplIdx);
     
             // Create a new page with the same size as the imported page
             $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
             $pdf->useTemplate($tplIdx);
     
             // Add the watermark
             $pdf->SetFont('Arial', 'B', 50);
             $pdf->SetTextColor(240, 90, 126);
     
             // Set position for bottom left corner
             $xPos = 10; // 10 units from the left edge
             $yPos = $size['height'] - 20; // 20 units above the bottom edge
     
             // Place the watermark text
             $pdf->SetXY($xPos, $yPos);
             $pdf->Text($xPos, $yPos, 'Confidential');
         }
     
         // Output the new PDF to the same path, overwriting the original file
         $pdf->Output($outputFilePath, 'F');
     
         return basename($outputFilePath); // Return the file name
     }


    // public function edit($id)
    // {
    //     $data = $this->servicemanuals_model->find($id);
    //     if ($data) {
    //         return $this->response->setJSON(['success' => true, 'data' => $data]);
    //     } else {
    //         return $this->response->setJSON(['success' => false, 'message' => 'Data not found']);
    //     }
    // }

    public function edit($id)
    {
        $data = $this->servicemanuals_model->getModelById($id);
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
                'model_code'  => 'required',
                'model_name'  => 'required',
            ]);
    
            if (!$validation->withRequest($this->request)->run()) {
                return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
            }
    
             // Get category and model_type values from the request
             $model_code = strtoupper($this->request->getPost('model_code'));
             $model_name = strtoupper($this->request->getPost('model_name'));
 
             // Load the MotorcycleCategoryModel (assuming you have this model)
             $motorcycleCategoryModel = new \App\Models\Motorcyclelist_model();
 
             // Retrieve the IndexKey from tbl_motorcycle_category
             $indexKey = $motorcycleCategoryModel->where('model_code', $model_code)
                                                 ->where('model_name', $model_name)
                                                 ->get()
                                                 ->getRow('IndexKey');
 
             if (!$indexKey) {
                 return $this->response->setJSON([
                     'success' => false,
                     'message' => 'Invalid model_code or model_name.'
                 ]);
             }
            // Load the session service
            $session = \Config\Services::session();
    
            $userData = [
                'motorcycle_id' => $indexKey, // Store the IndexKey as category_id or as needed
                'year_published'     => $this->request->getPost('year_published2'),
                'updated_at'   => date('Y-m-d H:i:s'),
                'updated_by'   => $session->get('login_firstname').' '. $session->get('login_lastname'),
            ];
    
            // Debug the data and ID
            log_message('debug', 'Update ID: ' . $id);
            log_message('debug', 'User Data: ' . print_r($userData, true));
    
            // Check if record with same data already exists
            $existingRecord = $this->servicemanuals_model->update_recordExists($userData, $id);
    
            if ($existingRecord) {
                return $this->response->setJSON(['success' => false, 'error' => 'Record with the same details already exists.']);
            }
    
            $this->servicemanuals_model->update($id, $userData);

            // Log activity
            $this->logActivity($session->get('login_username'), 'Update Service Manuals', $userData);
    
            return $this->response->setJSON(['success' => true]);
        }
    
        return redirect()->back();
    }
   
    
 

    public function getData()
    {
        // Fetch data with model type
        $datas = $this->servicemanuals_model->getDataWithModel();
        return $this->response->setJSON(['data' => $datas]);
    }
  
    public function activate($id)
    {
        if ($this->request->isAJAX()) {
            $model = new servicemanuals_model(); // Ensure this is the correct model
    
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
            $model = new servicemanuals_model(); // Ensure this is the correct model
            
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
                    $this->logActivity($session->get('login_username'), 'Deleted Service Bulletins', $motorcycleData);
    
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
    
    

