<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('admin', function ($routes) {
    $routes->get('/', 'DashboardController::index');
    $routes->group('category', function ($routes) {
        $routes->get('/', 'CategoryController::index', ['as' => 'category']);
        $routes->get('create', 'CategoryController::create', ['as' => 'category.create']);
        $routes->post('store', 'CategoryController::store', ['as' => 'category.store']);
        $routes->get('edit/(:num)', 'CategoryController::edit/$1', ['as' => 'category.edit']);
        $routes->post('update/(:num)', 'CategoryController::update/$1', ['as' => 'category.update']);
        $routes->delete('delete/(:num)', 'CategoryController::delete/$1', ['as' => 'category.delete']);
        $routes->get('show/(:num)', 'CategoryController::show/$1', ['as' => 'category.show']);
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
