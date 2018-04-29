<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'frontend';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**************ADMIN MODULE****************/
$route['admin'] = 'administrator/administrator';
$route['adminregister'] = 'administrator/administrator/register'; 
$route['adminlogin'] = 'administrator/administrator/login';
$route['dashboard'] = 'administrator/administrator/dashboard';
$route['adminlogout'] = 'administrator/administrator/logout';
/**************END ADMIN MODULE****************/


/**************CATEGORY MODULE****************/
// folder_name/controller_name/function_name  
$route['categories'] = 'categories/categories/index'; 
$route['addcategory'] = 'categories/categories/addcategory';
$route['category-details'] = 'categories/categories/categorydetails';
$route['category-delete'] = 'categories/categories/categorydelete';
/**************END CATEGORY MODULE****************/

/***************PRODUCT MODULE***************/
$route['products'] = 'products/products/index';
$route['addproduct'] = 'products/products/addproduct';
$route['product-details'] = 'products/products/productdetails';
$route['product-delete'] = 'products/products/productdelete';
/***************END PRODUCT MODULE***************/


/**************FRONTEND MODULE******************/
$route['register'] = 'frontend/frontend/register';
$route['registeruser'] = 'frontend/frontend/registeruser';
$route['login'] = 'frontend/frontend/login';
$route['loginuser'] = 'frontend/frontend/loginuser';
$route['logout'] = 'frontend/frontend/logout';
$route['products/(:num)'] = 'frontend/frontend/productsbycategory/$1';
$route['single-product-details'] = 'frontend/frontend/singleproductdetails';
$route['resetpassword'] = 'frontend/frontend/resetpassword';
$route['userprofile'] = 'frontend/frontend/userprofile';
$route['edituserprofile'] = 'frontend/frontend/edituserprofile';
$route['blockprofile'] = 'frontend/frontend/blockprofile';
$route['addtocart'] = 'frontend/frontend/addtocart';
$route['showcart'] = 'frontend/frontend/showcart';
$route['updatecart'] = 'frontend/frontend/updatecart';
$route['removeitem'] = 'frontend/frontend/removeitem';
$route['checkout'] = 'frontend/frontend/checkout';
/**************END FRONTEND MODULE**************/