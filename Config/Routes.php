<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'Login::index');
$routes->post('/login/authenticate', 'Login::authenticate');
$routes->post('/login/logout', 'Login::logout');

$routes->get('/sales_invoice', 'SalesInvoice::index');

$routes->get('/products', 'Products::index');
$routes->post('/products/save_product', 'Products::save_product');
$routes->post('/products/get_table_products', 'Products::get_table_products');
$routes->post('/products/edit_product', 'Products::edit_product');


