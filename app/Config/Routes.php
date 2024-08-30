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
// $routes->setDefaultController('Auth');
// $routes->setDefaultMethod('login');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('home');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
// $routes->setAutoRoute(false);
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
$routes->get('/', 'Home::index');
// $routes->get('/', 'Auth::login');

$routes->get('auth/login', 'Auth::login');
$routes->post('auth/proses_login', 'Auth::proses_login');
$routes->get('auth/logout', 'Auth::logout');
// $routes->get('auth/register', 'Auth::register');
// $routes->post('auth/proses_register', 'Auth::proses_register');

$routes->get('userlogin', 'Userlogin::index', ['filter' => 'authGuard']);
$routes->post('ajaxuserlogin', 'Userlogin::ajaxuserlogin', ['filter' => 'authGuard']);
$routes->get('userlogin/input', 'Userlogin::input', ['filter' => 'authGuard']);
$routes->get('userlogin/input/(:any)', 'Userlogin::input/$1', ['filter' => 'authGuard']);
$routes->post('userlogin/store', 'Userlogin::store', ['filter' => 'authGuard']);
$routes->get('userlogin/default/(:num)', 'Userlogin::defaultpassword/$1', ['filter' => 'authGuard']);
$routes->get('userlogin/delete/(:any)', 'Userlogin::delete/$1', ['filter' => 'authGuard']);

$routes->get('home', 'Home::index');
$routes->post('ajaxmaps', 'Home::ajaxmaps');
$routes->get('home/detail/(:any)', 'Home::detail/$1');

$routes->get('profile', 'Profile::index', ['filter' => 'authGuard']);
$routes->post('changename', 'Profile::changename', ['filter' => 'authGuard']);
$routes->post('changepass', 'Profile::changepass', ['filter' => 'authGuard']);
$routes->post('changepic', 'Profile::changepic', ['filter' => 'authGuard']);
$routes->post('changesign', 'Profile::changesign', ['filter' => 'authGuard']);

$routes->get('signature', 'Signature::index', ['filter' => 'authGuard']);
$routes->post('ajaxsignature', 'Signature::ajaxsignature', ['filter' => 'authGuard']);
$routes->get('signature/download/(:any)', 'Signature::download/$1', ['filter' => 'authGuard']);

$routes->get('notification', 'Notification::index', ['filter' => 'authGuard']);
$routes->post('ajaxnotification', 'Notification::ajaxnotification', ['filter' => 'authGuard']);
$routes->get('notification/markread/(:any)', 'Notification::markAsRead/$1', ['filter' => 'authGuard']);
$routes->post('getnotif', 'Notification::ajaxnotif', ['filter' => 'authGuard']);

$routes->get('kategori', 'Kategori::index', ['filter' => 'authGuard']);
$routes->post('ajaxkategori', 'Kategori::ajaxkategori', ['filter' => 'authGuard']);
$routes->get('kategori/input', 'Kategori::input', ['filter' => 'authGuard']);
$routes->get('kategori/input/(:any)', 'Kategori::input/$1', ['filter' => 'authGuard']);
$routes->post('kategori/store', 'Kategori::store', ['filter' => 'authGuard']);

$routes->get('kecamatan', 'Kecamatan::index', ['filter' => 'authGuard']);
$routes->post('ajaxkecamatan', 'Kecamatan::ajaxkecamatan', ['filter' => 'authGuard']);
$routes->get('kecamatan/input', 'Kecamatan::input', ['filter' => 'authGuard']);
$routes->get('kecamatan/input/(:any)', 'Kecamatan::input/$1', ['filter' => 'authGuard']);
$routes->post('ajaxdropkota/(:any)', 'Kecamatan::getregency/$1', ['filter' => 'authGuard']);

$routes->get('kelurahan', 'Kelurahan::index', ['filter' => 'authGuard']);
$routes->post('ajaxkelurahan', 'Kelurahan::ajaxkelurahan', ['filter' => 'authGuard']);
$routes->get('kelurahan/input', 'Kelurahan::input', ['filter' => 'authGuard']);
$routes->get('kelurahan/input/(:any)', 'Kelurahan::input/$1', ['filter' => 'authGuard']);
$routes->post('kelurahan/store', 'Kelurahan::store', ['filter' => 'authGuard']);
$routes->post('ajaxdropkota/(:any)', 'Kelurahan::getregency/$1', ['filter' => 'authGuard']);
$routes->post('ajaxdropkecamatan/(:any)', 'Kelurahan::getdistrict/$1', ['filter' => 'authGuard']);

$routes->get('obyek', 'Lokasi::index', ['filter' => 'authGuard']);
$routes->post('ajaxlokasi', 'Lokasi::ajaxlokasi', ['filter' => 'authGuard']);
$routes->get('obyek/input', 'Lokasi::input', ['filter' => 'authGuard']);
$routes->get('obyek/input/(:num)', 'Lokasi::input/$1', ['filter' => 'authGuard']);
$routes->post('obyek/store', 'Lokasi::store', ['filter' => 'authGuard']);
$routes->get('obyek/detail/(:num)', 'Lokasi::detail/$1', ['filter' => 'authGuard']);
$routes->post('ajaxlokasidtl/(:num)', 'Lokasi::ajaxlokasidtl/$1', ['filter' => 'authGuard']);
$routes->get('obyek/inputdtl/(:num)', 'Lokasi::inputdtl/$1', ['filter' => 'authGuard']);
$routes->get('obyek/inputdtl/(:num)/(:num)', 'Lokasi::inputdtl/$1/$2', ['filter' => 'authGuard']);
$routes->post('obyek/storedtl', 'Lokasi::additem', ['filter' => 'authGuard']);
$routes->get('obyek/delete/(:num)', 'Lokasi::delitem/$1', ['filter' => 'authGuard']);

$routes->get('mapskategori', 'Mapskategori::index');
$routes->post('ajaxmapskat', 'Mapskategori::ajaxmapskat');
$routes->post('mapskategori/(:num)', 'Mapskategori::katchanges/$1');

$routes->get('mapskecamatan', 'Mapsvillages::index');
$routes->post('ajaxmapskec', 'Mapsvillages::ajaxmapskec');
$routes->post('mapskecamatan/(:num)', 'Mapsvillages::kecchanges/$1');

$routes->get('mapsobject', 'Mapsobject::index');
$routes->post('ajaxmapsobj', 'Mapsobject::ajaxmapsobj');
$routes->post('mapsobject/(:any)', 'Mapsobject::searchobj/$1');

$routes->get('mapskatkec', 'Mapskatkec::index');
$routes->post('ajaxkatkec', 'Mapskatkec::ajaxkatkec');
$routes->post('mapskatkec/(:num)/(:num)', 'Mapskatkec::dropchanges/$1/$2');

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
