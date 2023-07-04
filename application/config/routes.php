<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['masuk.html'] = 'home/login';
$route['proses.html'] = 'home/login_proses';
$route['logout'] = 'home/logout';
$route['dashboard.html'] = 'dashboard';

$route['data-kapal.html'] = 'admin/kapal';
$route['get-kapal.html'] = 'admin/kapal/get_ajax';
$route['tambah-kapal.html'] = 'admin/kapal/tambah';
$route['kapal-add.html'] = 'admin/kapal/proses_tambah';
$route['ubah-kapal/(:any)'] = 'admin/kapal/edit/$1';
$route['hapus-kapal/(:any)'] = 'admin/kapal/delete/$1';
$route['kapal-update.html'] = 'admin/kapal/update';

$route['data-nelayan.html'] = 'admin/nelayan';
$route['get-nelayan.html'] = 'admin/nelayan/get_ajax';
$route['tambah-nelayan.html'] = 'admin/nelayan/tambah';
$route['nelayan-add.html'] = 'admin/nelayan/proses_tambah';
$route['ubah-nelayan/(:any)'] = 'admin/nelayan/edit/$1';
$route['hapus-nelayan/(:any)'] = 'admin/nelayan/delete/$1';
$route['nelayan-update.html'] = 'admin/nelayan/update';

$route['data-tpi.html'] = 'admin/tpi';
$route['get-tpi.html'] = 'admin/tpi/get_ajax';
$route['tambah-tpi.html'] = 'admin/tpi/tambah';
$route['tpi-add.html'] = 'admin/tpi/proses_tambah';
$route['ubah-tpi/(:any)'] = 'admin/tpi/edit/$1';
$route['hapus-tpi/(:any)'] = 'admin/tpi/delete/$1';
$route['tpi-update.html'] = 'admin/tpi/update';

$route['data-ikan.html'] = 'admin/ikan';
$route['get-ikan.html'] = 'admin/ikan/get_ajax';
$route['tambah-ikan.html'] = 'admin/ikan/tambah';
$route['ikan-add.html'] = 'admin/ikan/proses_tambah';
$route['ubah-ikan/(:any)'] = 'admin/ikan/edit/$1';
$route['hapus-ikan/(:any)'] = 'admin/ikan/delete/$1';
$route['ikan-update.html'] = 'admin/ikan/update';

$route['data-peta.html'] = 'admin/peta';
$route['tambah-peta.html'] = 'admin/peta/tambah';
$route['proses-tambah-peta.html'] = 'admin/peta/proses_tambah';
$route['ubah-peta/(:any)'] = 'admin/peta/edit/$1';
$route['hapus-peta/(:any)'] = 'admin/peta/delete/$1';

$route['data-survei.html'] = 'admin/survei';
// $route['get-kapal.html'] = 'admin/kapal/get_ajax';
// $route['tambah-kapal.html'] = 'admin/kapal/tambah';
$route['pertanyaan-add.html'] = 'admin/survei/proses_tambah';
$route['ubah-pertanyaan/(:any)'] = 'admin/survei/edit/$1';
$route['hapus-pertanyaan/(:any)'] = 'admin/survei/delete/$1';
$route['pertanyaan-update.html'] = 'admin/survei/update';

$route['profil.html'] = 'admin/pengaturan/profil';
$route['profil-update'] = 'admin/pengaturan/profil_update';

$route['kapal.html'] = 'home/data_kapal';
$route['nelayan.html'] = 'home/data_nelayan';
$route['tpi.html'] = 'home/data_tpi';
$route['ikan.html'] = 'home/data_ikan';
$route['peta.html'] = 'home/data_peta';
$route['survei.html'] = 'home/survei';
$route['kirim-survei.html'] = 'home/kirim_survei';
