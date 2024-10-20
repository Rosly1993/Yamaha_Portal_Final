<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('LoginController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->get('/', 'LoginController::index',['filter' => 'authenticated']);
$routes->get('/registration', 'LoginController::registration',['filter' => 'authenticated']);
$routes->get('/request_otp', 'LoginController::request_otp',['filter' => 'authenticated']);
$routes->get('/reset_password', 'LoginController::reset_password',['filter' => 'authenticated']);
$routes->get('LoginController', 'LoginController::index',['filter' => 'authenticated']);
$routes->get('LoginController/(:segment)', 'LoginController::$1',['filter' => 'authenticated']);
$routes->match(['post'], '/registration', 'LoginController::registration',['filter' => 'authenticated']);
$routes->match(['post'], '/request_otp', 'LoginController::request_otp',['filter' => 'authenticated']);
$routes->match(['post'], '/reset_password', 'LoginController::reset_password',['filter' => 'authenticated']);
$routes->match(['post'], '/login', 'LoginController::index',['filter' => 'authenticated']);
$routes->get('/logout', 'LoginController::logout');
$routes->get('getHeadoffice', 'LoginController::getHeadoffice');
$routes->get('getBranchname', 'LoginController::getBranchname');
$routes->get('getArea', 'LoginController::getArea');

$routes->group('Main', ['filter'=>'authenticate'], static function($routes){
    $routes->get('', 'Main::index');
    $routes->get('(:segment)', 'Main::$1');
    $routes->get('(:segment)/(:any)', 'Main::$1/$2');
    $routes->match(['post'], 'user_edit/(:num)', 'Main::user_edit/$1');
    $routes->match(['post'], 'changepassword', 'Main::changepassword');

 
});


$routes->group('Table', ['filter' => 'authenticate'], static function($routes) {
    $routes->get('', 'Table::index');  // Calls Table::index
    $routes->get('view/(:segment)', 'Table::view/$1');  // Calls Table::view($1)
    $routes->get('edit/(:segment)', 'Table::edit/$1');  // Calls Table::edit($1)
    $routes->get('activate/(:segment)', 'Table::activate/$1');  // Calls Table::delete($1)
    $routes->get('deactivate/(:segment)', 'Table::deactivate/$1');  // Calls Table::delete($1)
    $routes->get('lock/(:segment)', 'Table::lock/$1');  // Calls Table::delete($1)
    $routes->get('unlock/(:segment)', 'Table::unlock/$1');  // Calls Table::delete($1)
    $routes->post('add', 'Table::add');  // Calls Table::add
    $routes->post('update/(:segment)', 'Table::update/$1'); // Calls Table::update($1)
    $routes->get('getUsers', 'Table::getUsers');  // Calls Table::getUsers
    $routes->get('getHeadoffice', 'Table::getHeadoffice');
    $routes->get('getBranchname', 'Table::getBranchname');
    $routes->get('getArea', 'Table::getArea');
});

$routes->group('Motorcyclelist', ['filter' => 'authenticate'], static function($routes) {
    $routes->get('', 'Motorcyclelist::index');  // Calls Motorcyclelist::index
    $routes->get('view/(:segment)', 'Motorcyclelist::view/$1');  // Calls Motorcyclelist::view($1)
    $routes->get('edit/(:segment)', 'Motorcyclelist::edit/$1');  // Calls Motorcyclelist::edit($1)
    $routes->get('activate/(:segment)', 'Motorcyclelist::activate/$1');  // Calls Motorcyclelist::delete($1)
    $routes->get('deactivate/(:segment)', 'Motorcyclelist::deactivate/$1');  // Calls Motorcyclelist::delete($1)
    $routes->post('add', 'Motorcyclelist::add');  // Calls Motorcyclelist::add
    $routes->post('update/(:segment)', 'Motorcyclelist::update/$1'); // Calls Motorcyclelist::update($1)
    $routes->get('getData', 'Motorcyclelist::getData');  // Calls Motorcyclelist::getUsers
});


$routes->group('Motorcyclecategory', ['filter' => 'authenticate'], static function($routes) {
    $routes->get('', 'Motorcyclecategory::index');  // Calls Motorcyclecategory::index
    $routes->get('view/(:segment)', 'Motorcyclecategory::view/$1');  // Calls Motorcyclecategory::view($1)
    $routes->get('edit/(:segment)', 'Motorcyclecategory::edit/$1');  // Calls Motorcyclecategory::edit($1)
    $routes->get('activate/(:segment)', 'Motorcyclecategory::activate/$1');  // Calls Motorcyclecategory::delete($1)
    $routes->get('deactivate/(:segment)', 'Motorcyclecategory::deactivate/$1');  // Calls Motorcyclecategory::delete($1)
    $routes->post('add', 'Motorcyclecategory::add');  // Calls Motorcyclecategory::add
    $routes->post('update/(:segment)', 'Motorcyclecategory::update/$1'); // Calls Motorcyclecategory::update($1)
    $routes->get('getData', 'Motorcyclecategory::getData');  // Calls Motorcyclelist::getUsers
    $routes->get('getCategories', 'Motorcyclecategory::getCategories');
    $routes->get('getModelTypes', 'Motorcyclecategory::getModelTypes');


});


$routes->group('Location', ['filter' => 'authenticate'], static function($routes) {
    $routes->get('', 'Location::index');  // Calls Location::index
    $routes->get('view/(:segment)', 'Location::view/$1');  // Calls Location::view($1)
    $routes->get('edit/(:segment)', 'Location::edit/$1');  // Calls Location::edit($1)
    $routes->get('activate/(:segment)', 'Location::activate/$1');  // Calls Location::delete($1)
    $routes->get('deactivate/(:segment)', 'Location::deactivate/$1');  // Calls Location::delete($1)
    $routes->post('add', 'Location::add');  // Calls Location::add
    $routes->post('update/(:segment)', 'Location::update/$1'); // Calls Location::update($1)
    $routes->get('getData', 'Location::getData');  // Calls Motorcyclelist::getUsers
    $routes->get('getAreas', 'Location::getAreas');
    $routes->get('getRegion', 'Location::getRegion');
    $routes->get('getClusterProvince', 'Location::getClusterProvince');

});

$routes->group('Branchlist', ['filter' => 'authenticate'], static function($routes) {
    $routes->get('', 'Branchlist::index');  // Calls Branchlist::index
    $routes->get('view/(:segment)', 'Branchlist::view/$1');  // Calls Branchlist::view($1)
    $routes->get('edit/(:segment)', 'Branchlist::edit/$1');  // Calls Branchlist::edit($1)
    $routes->get('activate/(:segment)', 'Branchlist::activate/$1');  // Calls Branchlist::delete($1)
    $routes->get('deactivate/(:segment)', 'Branchlist::deactivate/$1');  // Calls Branchlist::delete($1)
    $routes->post('add', 'Branchlist::add');  // Calls Branchlist::add
    $routes->post('update/(:segment)', 'Branchlist::update/$1'); // Calls Branchlist::update($1)
    $routes->get('getData', 'Branchlist::getData');  // Calls Motorcyclelist::getUsers
    // $routes->get('getModelTypes', 'Branchlist::getModelTypes');
});


$routes->group('Servicebulletins', ['filter' => 'authenticate'], static function($routes) {
    $routes->get('', 'Servicebulletins::index');  // Calls Servicebulletins::index
    $routes->get('view/(:segment)', 'Servicebulletins::view/$1');  // Calls Servicebulletins::view($1)
    $routes->get('edit/(:segment)', 'Servicebulletins::edit/$1');  // Calls Servicebulletins::edit($1)
    $routes->get('activate/(:segment)', 'Servicebulletins::activate/$1');  // Calls Servicebulletins::delete($1)
    $routes->get('deactivate/(:segment)', 'Servicebulletins::deactivate/$1');  // Calls Servicebulletins::delete($1)
    $routes->post('add', 'Servicebulletins::add');  // Calls Servicebulletins::add
    $routes->post('update/(:segment)', 'Servicebulletins::update/$1'); // Calls Servicebulletins::update($1)
    $routes->get('getData', 'Servicebulletins::getData');  // Calls Motorcyclelist::getUsers
    $routes->get('files/(:segment)', 'FileController::view/$1');
    $routes->get('files/download/(:segment)', 'FileController::download/$1');

});



$routes->group('Servicemanuals', ['filter' => 'authenticate'], static function($routes) {
    $routes->get('', 'Servicemanuals::index');  // Calls Servicemanuals::index
    $routes->get('view/(:segment)', 'Servicemanuals::view/$1');  // Calls Servicemanuals::view($1)
    $routes->get('edit/(:segment)', 'Servicemanuals::edit/$1');  // Calls Servicemanuals::edit($1)
    $routes->get('activate/(:segment)', 'Servicemanuals::activate/$1');  // Calls Servicemanuals::delete($1)
    $routes->get('deactivate/(:segment)', 'Servicemanuals::deactivate/$1');  // Calls Servicemanuals::delete($1)
    $routes->post('add', 'Servicemanuals::add');  // Calls Servicemanuals::add
    $routes->post('update/(:segment)', 'Servicemanuals::update/$1'); // Calls Servicemanuals::update($1)
    $routes->get('getData', 'Servicemanuals::getData');  // Calls Motorcyclelist::getUsers
    $routes->get('files/(:segment)', 'FileController::view/$1');
    $routes->get('files/download/(:segment)', 'FileController::download/$1');
    $routes->get('getModelnames', 'Servicemanuals::getModelnames');
    $routes->get('getModelcodes', 'Servicemanuals::getModelcodes');

});
$routes->group('Activitylogs', ['filter' => 'authenticate'], static function($routes) {
    $routes->get('', 'Activitylogs::index');  // Displays the index view
    $routes->get('view/(:segment)', 'Activitylogs::view/$1');  // Shows the view method with segment
    $routes->get('getData', 'Activitylogs::getData');  // Calls Motorcyclelist::getUsers
});



$routes->group('Rolespermission', ['filter' => 'authenticate'], static function($routes) {
    $routes->get('', 'Rolespermission::index');  // Calls Rolespermission::index
    $routes->get('view/(:segment)', 'Rolespermission::view/$1');  // Calls Rolespermission::view($1)
    $routes->get('edit/(:segment)', 'Rolespermission::edit/$1');  // Calls Rolespermission::edit($1)
    $routes->get('activate/(:segment)', 'Rolespermission::activate/$1');  // Calls Rolespermission::delete($1)
    $routes->get('deactivate/(:segment)', 'Rolespermission::deactivate/$1');  // Calls Rolespermission::delete($1)
    $routes->post('add', 'Rolespermission::add');  // Calls Rolespermission::add
    $routes->post('update/(:segment)', 'Rolespermission::update/$1'); // Calls Rolespermission::update($1)
    // $routes->post('update', 'Rolespermission::update');
    $routes->get('getData', 'Rolespermission::getData');  // Calls Motorcyclelist::getUsers
    $routes->get('getAreas', 'Rolespermission::getAreas');
    $routes->get('getRegion', 'Rolespermission::getRegion');
    $routes->get('getClusterProvince', 'Rolespermission::getClusterProvince');

});


$routes->group('Profile', ['filter' => 'authenticate'], static function($routes) {
    $routes->get('', 'Profile::index');  // Calls Profile::index
    $routes->get('view/(:segment)', 'Profile::view/$1');  // Calls Profile::view($1)
    $routes->get('edit/(:segment)', 'Profile::edit/$1');  // Calls Profile::edit($1)
    $routes->get('activate/(:segment)', 'Profile::activate/$1');  // Calls Profile::delete($1)
    $routes->get('deactivate/(:segment)', 'Profile::deactivate/$1');  // Calls Profile::delete($1)
    $routes->post('add', 'Profile::add');  // Calls Profile::add
    $routes->post('update/(:segment)', 'Profile::update/$1'); // Calls Profile::update($1)
    $routes->get('getData', 'Profile::getData');  // Calls Motorcyclelist::getUsers
    $routes->get('getAreas', 'Profile::getAreas');
    $routes->get('getRegion', 'Profile::getRegion');
    $routes->get('getClusterProvince', 'Profile::getClusterProvince');

});

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
