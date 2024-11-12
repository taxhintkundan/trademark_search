<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// form filling 'http://localhost/ci-app/index.php/trademarks'
$route['trademarks'] = 'trademarks/index';
$route['trademarks/submit'] = 'trademarks/submit';

// details search  'http://localhost/ci-app/index.php/trademarks/search'
// $route['trademarks/search'] = 'trademarks/search';
// $route['trademarks/search_results'] = 'trademarks/search_results';




// Final routes
// $route['trademark/add'] = 'trademark/add';//http://localhost/ci-app/index.php/trademarks/add
$route['trademark/search'] = 'trademark/search';//http://localhost/ci-app/index.php/trademarks/search
// $route['trademark/details/(:any)'] = 'trademark/details/$1';
// $route['trademark/details/(:any)/(:any)/(:any)'] = 'trademark/details/$1/$2/$3';
$route['trademark/details/(:any)/(:any)/(:any)'] = 'trademark/details/$3';

$route['trademarks'] = 'trademarks/dashboard'; //trademark_dashboard

$route['default_controller'] = 'trademark/add'; // Optional
$route['trademarks/success'] = 'trademarks/success'; // Define the route
$route['trademarks/search_suggestions'] = 'trademarks/search_suggestions';//search suggestions


//api routes
$route['api_keys/generate'] = 'api_keys/generate';
$route['api_keys/list'] = 'api_keys/list';
$route['api_keys/delete/(:num)'] = 'api_keys/delete/$1';
// download image through api
$route['api/download_image/(:num)'] = 'trademarks/download_image/$1';

