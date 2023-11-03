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
    $routes->get('/jenis', 'Jenis::index');
    $routes->get('/jenis/edit', 'Jenis:edit');
    $routes->get('/jenis/delete', 'Jenis:delete');
    $routes->get('/sifat', 'Sifat::index');
    $routes->get('/sifat/edit', 'Sifat:edit');
    $routes->get('/sifat/delete', 'Sifat:delete');
    $routes->get('/urgensi', 'Urgensi::index');
    $routes->get('/urgensi/edit', 'Urgensi:edit');
    $routes->get('/urgensi/delete', 'Urgensi:delete');
    $routes->get('/klasifikasi', 'Klasifikasi::index');
    $routes->get('/klasifikasi/edit', 'Klasifikasi:edit');
    $routes->get('/klasifikasi/delete', 'Klasifikasi:delete');
    $routes->get('/reg-naskah-masuk','Naskah::reg_masuk');
    $routes->get('/reg-naskah-keluar','Naskah::reg_keluar');
    $routes->post('/submit-naskah-masuk','Naskah::submit_masuk');
    $routes->post('/submit-naskah-keluar','Naskah::submit_keluar');
    $routes->get('/naskah-masuk','Naskah::naskah_masuk');
    $routes->get('/naskah-keluar','Naskah::naskah_keluar');
    $routes->get('/log-naskah-masuk','Naskah::log_naskah_masuk');
    $routes->get('/log-naskah-keluar','Naskah::log_naskah_keluar');
    $routes->get('/naskah/edit_naskah_masuk_form(:any)','Naskah::edit_naskah_masuk_form/$1');
    $routes->get('/naskah/edit_naskah_keluar_form(:any)','Naskah::edit_naskah_keluar_form/$1');
    $routes->get('/naskah/edit_naskah_masuk','Naskah::edit_naskah_masuk');
    $routes->get('/naskah/edit_naskah_keluar','Naskah::edit_naskah_keluar');
    $routes->get('/naskah/delete_naskah_masuk','Naskah::delete');
    $routes->get('/naskah/delete_naskah_keluar','Naskah::delete_naskah_keluar');
    $routes->get('/getnomor/(:any)','Naskah::getNomor/$1');
    // $routes->get('/download-naskah-masuk','Naskah::download_masuk/(:any)');
    $routes->get('/template','Naskah::template');
    $routes->get('/download-naskah-masuk(:any)','Naskah::download_naskah_masuk/$1');
    $routes->get('/download-lampiran-masuk(:any)','Naskah::download_lampiran_masuk/$1');
    $routes->get('/download-naskah-keluar(:any)','Naskah::download_naskah_keluar/$1');
    $routes->get('/download-lampiran-keluar(:any)','Naskah::download_lampiran_keluar/$1');
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
