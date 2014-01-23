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

$route['event/tagged/(:any)']   			= 'event/tagged/$1';
$route['event/admin/categories(/:any)?'] 	= 'admin_categories$1';
$route['event/admin/fields(/:any)?']		= 'admin_fields$1';
$route['event/admin(/:any)']  			= 'admin$1';
$route['event/(:any)']   					= 'event/view/$1';
$route['event/page(/:num)?']           	= 'event/index$2';
$route['event/rss/all.rss']            	= 'rss/index';
$route['event/rss/(:any).rss']         	= 'rss/category/$1';
