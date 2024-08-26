<?php

namespace App\Controllers;
use App\Models\Activitylogs_model;

class Activitylogs extends BaseController
{
    protected $request;
    protected $session;
    protected $activitylogs_model;
    protected $data;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->activitylogs_model = new Activitylogs_model();
        $this->data = ['session' => $this->session];
    }



    public function index()
    {
        $this->data['page_title'] = "Activitylogs";
        return view('pages/activitylogs', $this->data);
    }
   
   
    
    public function getData()
    {
        $request = service('request');
        $month = $request->getGet('month');
        $year = $request->getGet('year');
    
        // If no month/year is selected, use the current month and year
        if (!$month || !$year) {
            $month = date('m');
            $year = date('Y');
        }
    
        // Get pagination and search parameters
        $start = $request->getGet('start');
        $length = $request->getGet('length');
        $searchValue = $request->getGet('search')['value'];
    
        // Get sorting parameters with fallback to default
        $order = $request->getGet('order');
        $columns = ['IndexKey', 'username', 'activity', 'details', 'date_record']; // Columns array
        
        // Set default sorting parameters if 'order' is not set
        $orderColumn = $order[0]['column'] ?? 0; // Default to first column if not provided
        $orderDir = $order[0]['dir'] ?? 'asc';   // Default to ascending order if not provided
    
        // Query the total number of records
        $totalRecords = $this->activitylogs_model->countAll();
    
        // Apply filters and search
        $query = $this->activitylogs_model
                      ->where('MONTH(date_record)', $month)
                      ->where('YEAR(date_record)', $year);
    
        if ($searchValue) {
            $query = $query->groupStart()
                           ->like('username', $searchValue)
                           ->orLike('activity', $searchValue)
                           ->orLike('details', $searchValue)
                           ->groupEnd();
        }
    
        // Apply sorting
        if (isset($columns[$orderColumn])) {
            $query->orderBy($columns[$orderColumn], $orderDir);
        }
    
        // Get filtered data and count
        $totalFiltered = $query->countAllResults(false);
    
        // Handle the "All" case when length is -1
        if ($length == -1) {
            $data = $query->findAll();  // Retrieve all rows
        } else {
            $data = $query->findAll($length, $start);  // Retrieve paginated rows
        }
    
        // Prepare the response
        $response = [
            "draw" => intval($request->getGet('draw')),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        ];
    
        return $this->response->setJSON($response);
    }
    
   
   
 
}
    
    

