<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login']  = 'site/login';
$route['logout'] = 'site/logout';
$route['error_log'] = 'site/error_log';
$route['profil'] = 'site/profil';

$route['pdf/(:any)'] = 'pdf/view/$1';
$route['var/(:any)'] = 'pdf/variabel/$1';
$route['ind/(:any)'] = 'pdf/indikator/$1';
