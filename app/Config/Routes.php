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
$routes->get('LoginController', 'LoginController::index',['filter' => 'authenticated']);
$routes->get('LoginController/(:segment)', 'LoginController::$1',['filter' => 'authenticated']);
$routes->match(['post'], '/registration', 'LoginController::registration',['filter' => 'authenticated']);
$routes->match(['post'], '/login', 'LoginController::index',['filter' => 'authenticated']);
$routes->get('/logout', 'LoginController::logout');

$routes->group('Main', ['filter'=>'authenticate'], static function($routes){
    $routes->get('', 'Main::index');
    $routes->get('(:segment)', 'Main::$1');
    $routes->get('(:segment)/(:any)', 'Main::$1/$2');
    $routes->match(['post'], 'user_edit/(:num)', 'Main::user_edit/$1');
    
});
$routes->group('Table', ['filter' => 'authenticate'], static function($routes) {
    $routes->get('', 'Table::index');  // Calls Table::index
    $routes->get('view/(:segment)', 'Table::view/$1');  // Calls Table::view($1)
    $routes->get('edit/(:segment)', 'Table::edit/$1');  // Calls Table::edit($1)
    $routes->get('activate/(:segment)', 'Table::activate/$1');  // Calls Table::delete($1)
    $routes->get('deactivate/(:segment)', 'Table::deactivate/$1');  // Calls Table::delete($1)
    $routes->post('add', 'Table::add');  // Calls Table::add
    $routes->post('update/(:segment)', 'Table::update/$1'); // Calls Table::update($1)
    $routes->get('getUsers', 'Table::getUsers');  // Calls Table::getUsers
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



if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
