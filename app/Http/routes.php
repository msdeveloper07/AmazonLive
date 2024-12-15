<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('activate/{code}','ActivationController@activate');
Route::get('/', function () {
    if ((isset(Auth::user()->user_group_id) ? Auth::user()->user_group_id : '') == '1'){
        return redirect('/dashboard');
    }
    elseif((isset(Auth::user()->user_group_id) ? Auth::user()->user_group_id : '') == '2'){
        return redirect('/products');
    }
//    return redirect('/login');
    return view('welcome');
});




Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('dashboard', 'HomeController@index');

    Route::get('products', 'ProductController@index');
    Route::get('products/view/{promo_id}', 'ProductController@productView');
    Route::get('products/reviewproduct/{promo_id}', 'ProductController@reviewProduct');   
     
    
    Route::post('saveReview/{promo_id}', 'ProductController@saveReview');    


 //    -------- Users Route---------
    $router->resource('users', 'UserController');
    $router->get('user/activity/{id}','UserController@userActivity');
    
    $router->post('updateusers/{id}', 'UserController@updateRegisterUser');
    
    $router->post('userAction', 'UserController@userAction');
    $router->get('userSearch/{search}', 'UserController@userSearch');
    
    $router->post('userStatus/{id}', 'UserController@userStatus');
    
    $router->get('/userScrap/{id}', 'UserController@userScrap');

    $router->get('userprofile/{id}', 'UserController@profile');
  
    $router->post('upload/profile/image', 'UserController@updateProfileImage');
    $router->post('updateprofile', 'AjaxController@manageProfile');
    
    Route::get('/exportToCSVFile/{search}', 'UserController@exportToCSV');
    
    
    Route::get('supports', 'SupportController@supportIndex');
    $router->post('sendsupport', 'SupportController@sendSupportMail');
    

    //    -------- UserGroups Route---------
    $router->resource('userGroups', 'UserGroupController');
    $router->post('userGroupAction', 'UserGroupController@userGroupAction');
    $router->get('userGroupSearch/{search}', 'UserGroupController@userGroupSearch');

    //    -------- userGroupPermissions Route---------
    $router->resource('userGroupPermissions', 'UserGroupPermissionController');
    $router->post('userGroupPermissionAction', 'UserGroupPermissionController@userGroupPermissionAction');
    $router->get('userGroupPermissionSearch/{search}', 'UserGroupPermissionController@userGroupPermissionSearch');

    //    -------- Permissions Route---------    
    $router->resource('permissions', 'PermissionsController');
    $router->post('permissionAction', 'PermissionsController@permissionAction');
    $router->get('permissionSearch/{search}', 'PermissionsController@permissionSearch');

    //    -------- Promos Route---------
    $router->resource('promos', 'PromoController');
    $router->post('batchfilesave/{promo_id}', 'PromoController@batchFileSave');
    $router->post('promoAction', 'PromoController@promoAction');
    $router->get('promoSearch/{search}', 'PromoController@promoSearch');
    
    $router->get('/email_template/{id}/{promo_id?}/', 'PromoController@emailTemplate');
    $router->post('/email_template_save/{id}/{promo_id?}', 'PromoController@emailTemplateSave');

    
    Route::get('/{slug}', 'ReviewLandingPageController@productView');
    $router->post('savelandinguser/{slug}', 'ReviewLandingPageController@saveLandingUser');