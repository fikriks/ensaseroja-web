<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Home
$routes->get('home', 'Home::index');

// Batch
$routes->get('batch','Batch::index');
$routes->post('batch/ubah','Batch::ubah');
$routes->post('batch/tambah','Batch::tambah');
$routes->get('batch/hapus/(:num)','Batch::hapus/$1');

// Produk
$routes->get('produk','Produk::index');
$routes->post('produk/ubah','Produk::ubah');
$routes->post('produk/tambah','Produk::tambah');
$routes->get('produk/hapus/(:num)','Produk::hapus/$1');

// Info
$routes->get('info','Info::index');
$routes->post('info/ubah','Info::ubah');

// Login
$routes->get('/', 'Auth::index');
$routes->post("login", 'Auth::actLogin');

// Logout
$routes->get("logout", 'Auth::logout');
$routes->post("dataJSONProduct", "Batch::returnJSONENC");

// API
$routes->post('c_api','C_API::index');
$routes->get('getDataHome','C_API::getDataHome');
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
