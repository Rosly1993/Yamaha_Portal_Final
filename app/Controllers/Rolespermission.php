<?php

namespace App\Controllers;
use App\Models\Rolespermission_model;
use App\Models\Roles_model;
use App\Models\Pages_model;
use CodeIgniter\Controller;

class Rolespermission extends BaseController
{
    protected $request;
    protected $session;
    protected $rolespermission_model;
    protected $roles_model;
    protected $pages_model;
    protected $data;
    protected $db; // Declare the $db property

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->rolespermission_model = new Rolespermission_model();
        $this->roles_model = new Roles_model();
        $this->pages_model = new Pages_model();
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
            'page_name' => 'Roles_permission',
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
            $this->data['pagename'] = $this->pages_model->getActivePages();
            $this->data['page_title'] = "Rolespermission";
            return view('pages/rolespermission', $this->data);
    
            } else {
                // Return the 404 error view if access is not allowed
                return view('errors/html/error_403');
            }
        }


    private function logActivity($username, $activity, $data)
    {
        $logModel = new \App\Models\LogModel();
        $details = json_encode($data);
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

    public function getData()
    {
        $datas = $this->rolespermission_model->getJoinedData();
        return $this->response->setJSON(['data' => $datas]);
    }


    public function add()
    {
        if ($this->request->isAJAX()) {
            $role_id = $this->request->getPost('role_id');
            $page_names = $this->request->getPost('page_names') ?? [];
            $is_add_values = $this->request->getPost('is_add') ?? [];
            $is_edit_values = $this->request->getPost('is_edit') ?? [];
            $is_view_values = $this->request->getPost('is_view') ?? [];
            $is_delete_values = $this->request->getPost('is_delete') ?? [];
    
            // Check if role exists in the database
            $existing_role = $this->rolespermission_model->getRoleByName($role_id);
            if ($existing_role) {
                $response = [
                    'success' => false,
                    'message' => 'Role already exists!'
                ];
            } else {
                 // Load the session service
                $session = \Config\Services::session();
                // Prepare data for insertion
                $data = [];
                for ($i = 0; $i < count($page_names); $i++) {
                    $data[] = [
                        'role_id' => $role_id,
                        'page_name' => $page_names[$i] ?? null,
                        'is_add' => isset($is_add_values[$i]) ? 1 : 0,
                        'is_edit' => isset($is_edit_values[$i]) ? 1 : 0,
                        'is_view' => isset($is_view_values[$i]) ? 1 : 0,
                        'is_delete' => isset($is_delete_values[$i]) ? 1 : 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by'  => $session->get('login_firstname').' '. $session->get('login_lastname'),
                        'is_active' => 1
                    ];
                }
    
                if (!empty($data)) {
                    $this->rolespermission_model->insertBatch($data);
                    // Log activity
                   $this->logActivity($session->get('login_username'), 'Add New Roles & Permission', $data);
                    $response = [
                        'success' => true,
                        'message' => 'Roles & permissions added successfully!'
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'No data to insert'
                    ];
                }
            }
    
            return $this->response->setJSON($response);
        }
    
        return redirect()->back();
    }
    
    public function edit($role_id)
    {
        $model = new Rolespermission_model();
        $data = $model->getRolePermissions($role_id);
    
        if ($data) {
            return $this->response->setJSON(['success' => true, 'data' => $data]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Data not found']);
        }
    }
    
    public function update()
    {
        $request = \Config\Services::request(); // Get the Request object

        $editedData = $request->getPost('editedData'); // Use getPost() to retrieve POST data
        $session = \Config\Services::session();
        if ($editedData) {
            foreach ($editedData as $entry) {
                $page_name = $entry['page_name'];
                $role_id = $entry['role_id'];
                $is_view = $entry['is_view'];
                $is_add = $entry['is_add'];
                $is_edit = $entry['is_edit'];
                $is_delete = $entry['is_delete'];

                $this->rolespermission_model->update_roles_permission($page_name, $role_id, $is_view, $is_add, $is_edit, $is_delete);
            }
            $this->logActivity($session->get('login_username'), 'Update Roles & Permission', $editedData);
            // Return success response
            echo json_encode(['success' => true]);
        } else {
            // Return error response
            echo json_encode(['success' => false, 'message' => 'No data received']);
        }
    }
   
// for deleting roles and ppermission
    public function deactivate($role_id)
    {
        if ($this->request->isAJAX()) {
            $model = new rolespermission_model(); // Ensure this is the correct model
    
            try {
                // Delete all records with the given role_id
                $result = $model->where('role_id', $role_id)->delete();
    
                if ($result) {
                    // Optionally log the deletion action
                    $session = session();
                    $this->logActivity($session->get('login_username'), 'Delete Roles by Role ID', ['role_id' => $role_id]);
    
                    return $this->response->setJSON(['success' => true]);
                } else {
                    return $this->response->setJSON(['success' => false, 'message' => 'Delete failed']);
                }
            } catch (\Exception $e) {
                return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    
        return redirect()->back();
    }
   
 
}
    
    

