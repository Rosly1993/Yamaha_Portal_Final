<?php

namespace App\Controllers;
require_once ROOTPATH . 'public/FPDF/fpdf.php'; // Ensure the path is correct
require_once ROOTPATH . 'public/FPDI/src/autoload.php'; // Ensure the path is correct

use App\Models\Servicebulletins_model;
use setasign\Fpdi\Fpdi;

class Servicebulletins extends BaseController
{
    protected $request;
    protected $session;
    protected $servicebulletins_model;
    protected $data;
    protected $db; // Declare the $db property

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->servicebulletins_model = new servicebulletins_model();
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
            'page_name' => 'Service_bulletin',
            'role_id' => $roles
        ]);

        // Get the result as an array
        $result_area = $query->getRowArray();

        if($daysRemaining < 1){
            // If the password has expired
            $this->data['page_title'] = "Expired";
            return view('pages/changepassword', $this->data);
    
          }elseif(isset($result_area['is_view']) && $result_area['is_view'] == 1){
            
           $this->data['page_title'] = "Servicebulletins";
           return view('pages/servicebulletins', $this->data);
    
            } else {
                // Return the 404 error view if access is not allowed
                return view('errors/html/error_403');
            }
        }

   

// get drop down  category and model type

public function getModelTypes()
{
    $categoryId = $this->request->getGet('category');

    // Load the model
    $model = new \App\Models\servicebulletins_model();

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
    $categoryModel = new \App\Models\servicebulletins_model();

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
                 'title'             => 'required',
                 'reference_number'  => 'required',
                
             ]);
     
             if (!$validation->withRequest($this->request)->run()) {
                 return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
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
                 'title'             => strtoupper($this->request->getPost('title')),
                 'reference_number'  => strtoupper($this->request->getPost('reference_number')),
                 'date_published'       => $this->request->getPost('date_published'),
                 'attachment' => $fileName, // Store the file name in the database
                 'is_confidential'   => $this->request->getPost('confidential_value'),
             ];

             
            // Add watermark if the bulletin is confidential
            if ($data['is_confidential'] == 1) {
                $this->addWatermark($filePath . $fileName);
            }

     
             if ($this->servicebulletins_model->recordExists(
                 $data['title'],
                 $data['reference_number']
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
     
             $this->servicebulletins_model->insert($userData);
     
             // Log activity
             $this->logActivity($session->get('login_username'), 'Add Service Bulletins', $userData);
     
             return $this->response->setJSON(['success' => true]);
         }
     
         return redirect()->back();
     }
     
     private function addWatermark($pdfFilePath)
     {
         $outputFilePath = $pdfFilePath; // Overwrite the original file
     
         // Path to the watermark image
         $watermarkImagePath = base_url('public/assets/uploads/Confidential.png');
     
         $pdf = new class extends Fpdi {
             private $extgstates = [];
     
             // Set transparency for watermark
             public function SetAlpha($alpha, $bm='Normal') {
                 // Define blend mode and transparency
                 $gs = $this->AddExtGState(['ca' => $alpha, 'CA' => $alpha]);
                 $this->SetExtGState($gs);
             }
     
             public function AddExtGState($parms) {
                 $n = count($this->extgstates) + 1;
                 $this->extgstates[$n]['parms'] = $parms;
                 return $n;
             }
     
             public function SetExtGState($gs) {
                 $this->_out(sprintf('/GS%d gs', $gs));
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
     
             // Set opacity for the watermark
             $pdf->SetAlpha(0.5); // Adjust opacity here (0.0 = fully transparent, 1.0 = fully opaque)
     
             // Add the watermark image in the center of the page
             $watermarkWidth = 100;  // Adjust the width of the watermark image
             $watermarkHeight = 100;  // Adjust the height of the watermark image
     
             $xPos = ($size['width'] - $watermarkWidth) / 2; // Center horizontally
             $yPos = ($size['height'] - $watermarkHeight) / 2; // Center vertically
     
             // Add PNG watermark
             $pdf->Image($watermarkImagePath, $xPos, $yPos, $watermarkWidth, $watermarkHeight, 'PNG');
     
             // Reset opacity to normal for the rest of the content
             $pdf->SetAlpha(1);
         }
     
         // Output the new PDF to the same path, overwriting the original file
         $pdf->Output($outputFilePath, 'F');
     
         return basename($outputFilePath); // Return the file name
     }
     
     

    public function edit($id)
    {
        $data = $this->servicebulletins_model->find($id);
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
                'title'  => 'required',
                'reference_number'  => 'required',
            ]);
    
            if (!$validation->withRequest($this->request)->run()) {
                return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
            }
    
            // Load the session service
            $session = \Config\Services::session();
    
            $userData = [
                'title'  => strtoupper($this->request->getPost('title')),
                'reference_number'     => strtoupper($this->request->getPost('reference_number')),
                'date_published'     => $this->request->getPost('date_published'),
                'updated_at'   => date('Y-m-d H:i:s'),
                'updated_by'   => $session->get('login_firstname').' '. $session->get('login_lastname'),
            ];
    
            // Debug the data and ID
            log_message('debug', 'Update ID: ' . $id);
            log_message('debug', 'User Data: ' . print_r($userData, true));
    
            // Check if record with same data already exists
            $existingRecord = $this->servicebulletins_model->update_recordExists($userData, $id);
    
            if ($existingRecord) {
                return $this->response->setJSON(['success' => false, 'error' => 'Record with the same details already exists.']);
            }
    
            $this->servicebulletins_model->update($id, $userData);

            // Log activity
            $this->logActivity($session->get('login_username'), 'Update Service Bulletins', $userData);
    
            return $this->response->setJSON(['success' => true]);
        }
    
        return redirect()->back();
    }
   
    
    public function getData()
    {
     
        $datas = $this->servicebulletins_model->where('is_active', 1)->findAll();
        return $this->response->setJSON(['data' => $datas]);
    }
  
    public function activate($id)
    {
        if ($this->request->isAJAX()) {
            $model = new servicebulletins_model(); // Ensure this is the correct model
    
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
            $model = new servicebulletins_model(); // Ensure this is the correct model
            
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
    
    

