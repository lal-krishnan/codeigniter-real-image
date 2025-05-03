<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('/x', 'OrderController::index');

$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->post('/create-order', 'OrderController::submitOrder');

    $routes->get('/orders', 'OrderController::orderList');
    $routes->get('/orders/view/(:num)', 'OrderController::viewOrder/$1');
    $routes->get('/orders/edit/(:num)', 'OrderController::editOrder/$1');
    $routes->post('/orders/update/(:num)', 'OrderController::updateOrder/$1');
    $routes->get('/orders/delete/(:num)', 'OrderController::deleteOrder/$1');
    $routes->get('/orders/create', 'OrderController::create');
    $routes->post('/orders/create', 'OrderController::submitOrder');
    $routes->get('/orders/new', 'OrderController::index');
    
    $routes->post('/orders/update-workflow/(:num)', 'OrderController::updateWorkFlow/$1');

    
    $routes->get('/orders/create', 'OrderController::create');
    
    $routes->post('/orders/line-create', 'OrderController::submitOrderLines');
    $routes->get('/order/ajax/line-list', 'OrderController::loadLineHTML');
    
     $routes->post('order/ajax/detatils-line-list/(:num)', 'OrderController::loadDetailsLineHTML/$1');
     $routes->post('order-item/updateStatus', 'OrderController::updateOrderItemStatus');
     
    $routes->post('/customers/get-user-by-mobile', 'CustomerController::getUserByMobile');
    $routes->get('/customers/get-user-by-mobile', 'CustomerController::getUserByMobile');
    
});


$routes->get('/login', 'Authentication::login');
$routes->post('/login', 'Authentication::login');
$routes->get('/logout', 'Authentication::logout');
$routes->get('/register', 'Authentication::register');
$routes->post('/register', 'Authentication::register');