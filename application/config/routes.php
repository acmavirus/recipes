<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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

$route['default_controller'] = 'Recipes/index';
$route['404_override'] = 'Home/notfound';
$route['translate_uri_dashes'] = FALSE;

// =====> ADMIN DASHBOARD <=====
$route['admin'] = 'admin/auth';
$route['admin/(:any)'] = 'admin/$1';
$route['admin/(:any)/(:any)'] = 'admin/$1/$2';
$route['admin/(:any)/(:any)/(:any)'] = 'admin/$1/$2/$3';
$route['admin/(:any)/(:any)/(:any)/(:any)'] = 'admin/$1/$2/$3/$4';
// =====> =============== <=====

// ======>      HOME     <======
$route['(:any)-post.html'] = 'Post/index/$1';
// =====> =============== <=====
// =====>     RECIPES     <=====
$route['recipes/page'] = 'Recipes/index/1';
$route['recipes/page/(:any)'] = 'Recipes/index/$1';
$route['recipes/(:any)-cat.html'] = 'Recipes/category/$1';
$route['recipes/(:any)/page'] = 'Recipes/category/$1';
$route['recipes/(:any)/page/(:any)'] = 'Recipes/category/$1/$2';
$route['recipes/(:any)-det.html'] = 'Recipes/detail/$1';
$route['recipes/search'] = 'Recipes/search';
// =====> =============== <=====
// =====>     CAR-DRIVING     <=====
$route['car-driving'] = 'cardriving/index';
$route['car-driving/(:any)'] = 'cardriving/page/$1';
$route['car-driving/(:any)/(:any)'] = 'cardriving/page/$1/$2';
// ======>      SEO     <======
$route['sitemap.xml'] = 'Seo/sitemap';
$route['sitemap_(:any)_(:any).xml'] = 'Seo/$1/$2';
$route['sitemap_(:any).xml'] = 'Seo/$1';
// =====> =============== <=====