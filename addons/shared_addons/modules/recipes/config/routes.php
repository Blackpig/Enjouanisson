<?php  defined('BASEPATH') or exit('No direct script access allowed');
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
| 	www.your-site.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://www.codeigniter.com/user_guide/general/routing.html
*/

// public
$route['recipes/tagged/(:any)']   			= 'recipes/tagged/$1';
$route['recipes/admin/categories(/:any)?'] 	= 'admin_categories$1';
$route['recipes/admin/fields(/:any)?']		= 'admin_fields$1';
$route['recipes/admin(/:any)']  			= 'admin$1';
$route['recipes/(:any)']   					= 'recipes/view/$1';
$route['recipes/page(/:num)?']           	= 'recipes/index$2';
$route['recipes/rss/all.rss']            	= 'rss/index';
$route['recipes/rss/(:any).rss']         	= 'rss/category/$1';
// admin
