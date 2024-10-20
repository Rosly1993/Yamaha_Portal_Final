
<?php  
// Load the session service
$session = session();
$user_roles = $session->get('login_role_id');

// Load the database connection
$db = \Config\Database::connect();

// Role name to check
$role_name = $user_roles; // Ensure this is the correct role

// Query the permissions for the Motorcycle_list page and the user's role
$query_motorcyclelist = $db->table('tbl_roles_permission')
    ->where('page_name', 'Motorcycle_list')
    ->where('role_id', $role_name)
    ->get();

// Initialize variables to hold permission data with default values as false
$is_view_motorcyclelist = $is_add_motorcyclelist = $is_edit_motorcyclelist = $is_delete_motorcyclelist = false;

// Check if there are any permissions for motorcyclelist
if ($query_motorcyclelist->getNumRows() > 0) {
    // Loop through each permission
    foreach ($query_motorcyclelist->getResult() as $row) {
        // Assign permission values
        $is_view_motorcyclelist = (bool)$row->is_view;
        $is_add_motorcyclelist = (bool)$row->is_add;
        $is_edit_motorcyclelist = (bool)$row->is_edit;
        $is_delete_motorcyclelist = (bool)$row->is_delete;
    }
}

// Query the permissions for the 3s_branchlist page and the user's role
$query_3s_branchlist = $db->table('tbl_roles_permission')
    ->where('page_name', '3s_branchlist')
    ->where('role_id', $role_name)
    ->get();

// Initialize variables to hold permission data with default values as false
$is_view_3s_branchlist = $is_add_3s_branchlist = $is_edit_3s_branchlist = $is_delete_3s_branchlist = false;

// Check if there are any permissions for 3s_branchlist
if ($query_3s_branchlist->getNumRows() > 0) {
    // Loop through each permission
    foreach ($query_3s_branchlist->getResult() as $row) {
        // Assign permission values
        $is_view_3s_branchlist = (bool)$row->is_view;
        $is_add_3s_branchlist = (bool)$row->is_add;
        $is_edit_3s_branchlist = (bool)$row->is_edit;
        $is_delete_3s_branchlist = (bool)$row->is_delete;
    }
}

// Query the permissions for the Service_manual page and the user's role
$query_Service_manual = $db->table('tbl_roles_permission')
    ->where('page_name', 'Service_manual')
    ->where('role_id', $role_name)
    ->get();

// Initialize variables to hold permission data with default values as false  
$is_view_Service_manual = $is_add_Service_manual = $is_edit_Service_manual = $is_delete_Service_manual = false;

// Check if there are any permissions for Service_manual 
if ($query_Service_manual->getNumRows() > 0) {
    // Loop through each permission
    foreach ($query_Service_manual->getResult() as $row) {
        // Assign permission values
        $is_view_Service_manual = (bool)$row->is_view;
        $is_add_Service_manual = (bool)$row->is_add;
        $is_edit_Service_manual = (bool)$row->is_edit;
        $is_delete_Service_manual = (bool)$row->is_delete;
    }
}

// Query the permissions for the Service_bulletin page and the user's role
$query_Service_bulletin = $db->table('tbl_roles_permission')
    ->where('page_name', 'Service_bulletin')
    ->where('role_id', $role_name)
    ->get();

// Initialize variables to hold permission data with default values as false  
$is_view_Service_bulletin = $is_add_Service_bulletin = $is_edit_Service_bulletin = $is_delete_Service_bulletin = false;

// Check if there are any permissions for Service_bulletin 
if ($query_Service_bulletin->getNumRows() > 0) {
    // Loop through each permission
    foreach ($query_Service_bulletin->getResult() as $row) {
        // Assign permission values
        $is_view_Service_bulletin = (bool)$row->is_view;
        $is_add_Service_bulletin = (bool)$row->is_add;
        $is_edit_Service_bulletin = (bool)$row->is_edit;
        $is_delete_Service_bulletin = (bool)$row->is_delete;
    }
}

// Query the permissions for the Motorcycle_category page and the user's role
$query_Motorcycle_category = $db->table('tbl_roles_permission')
    ->where('page_name', 'Motorcycle_category')
    ->where('role_id', $role_name)
    ->get();

// Initialize variables to hold permission data with default values as false  
$is_view_Motorcycle_category = $is_add_Motorcycle_category = $is_edit_Motorcycle_category = $is_delete_Motorcycle_category = false;

// Check if there are any permissions for Motorcycle_category 
if ($query_Motorcycle_category->getNumRows() > 0) {
    // Loop through each permission
    foreach ($query_Motorcycle_category->getResult() as $row) {
        // Assign permission values
        $is_view_Motorcycle_category = (bool)$row->is_view;
        $is_add_Motorcycle_category = (bool)$row->is_add;
        $is_edit_Motorcycle_category = (bool)$row->is_edit;
        $is_delete_Motorcycle_category = (bool)$row->is_delete;
    }
}


// Query the permissions for the Location page and the user's role   
$query_Location = $db->table('tbl_roles_permission')
    ->where('page_name', 'Location')
    ->where('role_id', $role_name)
    ->get();

// Initialize variables to hold permission data with default values as false  
$is_view_Location = $is_add_Location = $is_edit_Location = $is_delete_Location = false;

// Check if there are any permissions for Location 
if ($query_Location->getNumRows() > 0) {
    // Loop through each permission
    foreach ($query_Location->getResult() as $row) {
        // Assign permission values
        $is_view_Location = (bool)$row->is_view;
        $is_add_Location = (bool)$row->is_add;
        $is_edit_Location = (bool)$row->is_edit;
        $is_delete_Location = (bool)$row->is_delete;
    }
}


// Query the permissions for the Location page and the user's role   Roles_permission
$query_Users = $db->table('tbl_roles_permission')
    ->where('page_name', 'Users')
    ->where('role_id', $role_name)
    ->get();

// Initialize variables to hold permission data with default values as false  
$is_view_Users = $is_add_Users = $is_edit_Users = $is_delete_Users = false;

// Check if there are any permissions for Users 
if ($query_Users->getNumRows() > 0) {
    // Loop through each permission
    foreach ($query_Users->getResult() as $row) {
        // Assign permission values
        $is_view_Users = (bool)$row->is_view;
        $is_add_Users = (bool)$row->is_add;
        $is_edit_Users = (bool)$row->is_edit;
        $is_delete_Users = (bool)$row->is_delete;
    }
}

// Query the permissions for the  Roles_permission page and the user's role  
$query_Roles_permission = $db->table('tbl_roles_permission')
    ->where('page_name', 'Roles_permission')
    ->where('role_id', $role_name)
    ->get();

// Initialize variables to hold permission data with default values as false  
$is_view_Roles_permission = $is_add_Roles_permission = $is_edit_Roles_permission = $is_delete_Roles_permission = false;

// Check if there are any permissions for Roles_permission 
if ($query_Roles_permission->getNumRows() > 0) {
    // Loop through each permission
    foreach ($query_Roles_permission->getResult() as $row) {
        // Assign permission values
        $is_view_Roles_permission = (bool)$row->is_view;
        $is_add_Roles_permission = (bool)$row->is_add;
        $is_edit_Roles_permission = (bool)$row->is_edit;
        $is_delete_Roles_permission = (bool)$row->is_delete;
    }
}



// Query the permissions for the  Roles_permission page and the user's role  
$query_Profile = $db->table('tbl_roles_permission')
    ->where('page_name', 'Profile')
    ->where('role_id', $role_name)
    ->get();

// Initialize variables to hold permission data with default values as false  
$is_view_Profile = $is_add_Profile = $is_edit_Profile = $is_delete_Profile = false;

// Check if there are any permissions for Profile 
if ($query_Profile->getNumRows() > 0) {
    // Loop through each permission
    foreach ($query_Profile->getResult() as $row) {
        // Assign permission values
        $is_view_Profile = (bool)$row->is_view;
        $is_add_Profile = (bool)$row->is_add;
        $is_edit_Profile = (bool)$row->is_edit;
        $is_delete_Profile = (bool)$row->is_delete;
    }
}


//profile info

// Query the permissions for the Roles_permission page and the user's role
$query_user_info = $db->table('users')
    ->select('tbl_roles.roles, tbl_3sbranch_list.head_office, tbl_3sbranch_list.dealer_name, tbl_location.area')
    ->join('tbl_roles', 'users.role_id = tbl_roles.IndexKey')
    ->join('tbl_3sbranch_list', 'users.branch_id = tbl_3sbranch_list.IndexKey')
    ->join('tbl_location', 'tbl_3sbranch_list.location_id = tbl_location.IndexKey')
    ->where('users.role_id', $role_name)  // Assuming $role_name is already defined
    ->get();

// Check if there are any permissions for Profile
if ($query_user_info->getNumRows() > 0) {
    // Loop through each permission
    foreach ($query_user_info->getResult() as $row) {
        // Assign permission values
        $roles = $row->roles;
        $head_office = $row->head_office;
        $dealer_name = $row->dealer_name;
        $area = $row->area;
    }
}

//service bulletins

// Query the permissions for the Roles_permission page and the user's role
$query_bulletins = $db->table('tbl_service_bulletins')
    ->select('title, reference_number, date_published')
    ->where('MONTH(created_at) = MONTH(NOW())')  // Filter for current month
    ->where('YEAR(created_at) = YEAR(NOW())')    // Filter for current year
    ->where('is_active', 1) 
    ->get();

// Check if there are any permissions for Profile
if ($query_bulletins->getNumRows() > 0) {
    // Loop through each permission
    foreach ($query_bulletins->getResult() as $row) {
        // Assign permission values
        $title = $row->title;
        $reference_number = $row->reference_number;
        $date_published = $row->date_published;
    }
}

//service bulletins
// Query the service manuals and join with motorcycle list
$query_manual = $db->table('tbl_service_manuals')
    ->select('tbl_motorcyclelist.model_name, tbl_motorcyclelist.model_code, tbl_service_manuals.year_published')
    ->join('tbl_motorcyclelist', 'tbl_service_manuals.motorcycle_id = tbl_motorcyclelist.IndexKey', 'left')
    ->where('MONTH(tbl_service_manuals.created_at)', date('n')) // Filter for current month
    ->where('YEAR(tbl_service_manuals.created_at)', date('Y'))  // Filter for current year
    ->where('tbl_service_manuals.is_active', 1)
    ->get();

// Check if there are any records
if ($query_manual->getNumRows() > 0) {
    // Loop through each result
    foreach ($query_manual->getResult() as $row) {
        // Assign values
        $model_name = $row->model_name;
        $model_code = $row->model_code;
        $year_published = $row->year_published;

        // Process your results as needed
    }
}

?>