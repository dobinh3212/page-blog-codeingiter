<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Trong Routes.php

$routes->get('/', 'BlogController::index', ['as' => '/']);

$routes->group('admin', function ($routes) {
    $routes->get('login', 'AuthController::login', ['as' => 'viewLogin']);
    $routes->post('login', 'AuthController::attemptLogin', ['as' => 'attemptLogin']);
    $routes->get('logout', 'AuthController::logout', ['as' => 'attemptLogout']);

    $routes->get('googleLogin', 'AuthController::googleLogin', ['as' => 'googleLogin']);
    $routes->get('googleLoginCallback', 'AuthController::googleLoginCallback', ['as' => 'googleLoginCallback']);

    $routes->get('facebookLogin', 'AuthController::facebookLogin', ['as' => 'facebookLogin']);
    $routes->get('facebookLoginCallback', 'AuthController::facebookLoginCallback', ['as' => 'facebookLoginCallback']);

    $routes->get('instagramLogin', 'AuthController::instagramLogin', ['as' => 'instagramLogin']);
    $routes->get('instagramLoginCallback', 'AuthController::instagramLoginCallback', ['as' => 'instagramLoginCallback']);
    
    $routes->group('', ['filter' => 'auth'], function ($routes) {
        $routes->get('/', 'DashboardController::index', ['as' => 'dashboard']);
        $routes->get('profile', 'UserController::getUser', ['as' => 'getUser']);
        $routes->post('editProfile', 'UserController::editProfile', ['as' => 'editProfile']);
        $routes->group('category', function ($routes) {
            $routes->get('/', 'CategoryController::index', ['as' => 'category']);
            $routes->get('create', 'CategoryController::create', ['as' => 'category.create']);
            $routes->post('store', 'CategoryController::store', ['as' => 'category.store']);
            $routes->get('edit/(:num)', 'CategoryController::edit/$1', ['as' => 'category.edit']);
            $routes->post('update/(:num)', 'CategoryController::update/$1', ['as' => 'category.update']);
            $routes->delete('delete/(:num)', 'CategoryController::delete/$1', ['as' => 'category.delete']);
            $routes->get('show/(:num)', 'CategoryController::show/$1', ['as' => 'category.show']);
        });
        $routes->group('user', function ($routes) {
            $routes->get('/', 'UserController::index', ['as' => 'user']);
            $routes->get('create', 'UserController::create', ['as' => 'user.create']);
            $routes->post('store', 'UserController::store', ['as' => 'user.store']);
            $routes->get('edit/(:num)', 'UserController::edit/$1', ['as' => 'user.edit']);
            $routes->post('update/(:num)', 'UserController::update/$1', ['as' => 'user.update']);
            $routes->delete('delete/(:num)', 'UserController::delete/$1', ['as' => 'user.delete']);
            $routes->get('show/(:num)', 'UserController::show/$1', ['as' => 'user.show']);
        });
        $routes->group('post', function ($routes) {
            $routes->get('/', 'PostController::index', ['as' => 'post']);
            $routes->get('create', 'PostController::create', ['as' => 'post.create']);
            $routes->post('store', 'PostController::store', ['as' => 'post.store']);
            $routes->get('edit/(:num)', 'PostController::edit/$1', ['as' => 'post.edit']);
            $routes->post('update/(:num)', 'PostController::update/$1', ['as' => 'post.update']);
            $routes->delete('delete/(:num)', 'PostController::delete/$1', ['as' => 'post.delete']);
            $routes->get('show/(:num)', 'PostController::show/$1', ['as' => 'post.show']);
        });
    });
});

$routes->group('work', function ($routes) {
    $routes->get('/', 'BlogController::work', ['as' => 'blog.work']);
    $routes->get('(:num)', 'BlogController::workDetail/$1', ['as' => 'blog.workDetail']);
});
$routes->get('blog', 'BlogController::blog', ['as' => 'blog.blog']);
$routes->get('(:any)', 'BlogController::postDetail/$1', ['as' => 'post.postDetail']);
