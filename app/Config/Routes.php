<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/login', 'Auth::login');

// aktifkan ini ketika sdh jadi 
$routes->group('', ['filter' => 'authfilter'], function($routes) {
    // $routes->get('/survey', 'Survey::index');
    // pra pemutakhiran lfsp2020
    $routes->get('/', 'Home::index');
    $routes->get('/entri', 'FormController::index');
    $routes->get('/rekap', 'Kemiskinan::rekap');
    $routes->get('/analisis', 'LaporanController::index');
    $routes->get('/analisis-p3ke', 'LaporanController::indexP3ke');
    $routes->get('/analisis-dtks', 'LaporanController::indexDtks');
    $routes->get('/analisis-podes', 'LaporanController::indexPodes');
    $routes->get('/visualisasi', 'Kemiskinan::visualisasi');
    $routes->get('/master', 'AdminController::master');
    $routes->get('/edit', 'AdminController::edit');
    $routes->get('/kelola', 'AdminController::kelolaUser');
    $routes->post('/user/add', 'AdminController::addUser');
    $routes->post('/user/edit', 'AdminController::editUser');
    $routes->post('/user/delete', 'AdminController::deleteUser');
    $routes->get('/rekap-podes', 'LaporanController::indexRekapPodes');
    $routes->get('/update-podes', 'AdminController::formPodes');
    $routes->post('/submit-podes', 'AdminController::submitFormPodes');
    $routes->get('/unduh-p3ke', 'AdminController::unduh_p3ke');
    $routes->get('/unduh-podes0', 'AdminController::unduh_podes0');
    $routes->get('/unduh-podes1', 'AdminController::unduh_podes1');
    $routes->get('/unduh-podes2', 'AdminController::unduh_podes2');
    $routes->get('/unduh-podes3', 'AdminController::unduh_podes3');
    $routes->get('/unduh-podes4', 'AdminController::unduh_podes4');
});

// Redirect 404 errors to the home page
$routes->get('dist/(:any)', 'AssetController::serveAsset/$1');
$routes->set404Override(function () {
    return redirect()->to('/');
});


// $routes->get('/', 'Home::index');
// $routes->get('/unggah-file', 'UploadKabkot::index');
// $routes->post('/import-csv','UploadKabkot::importCsvToDb');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
