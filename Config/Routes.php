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
$routes->post('/sales_invoice/get_products_clients', 'SalesInvoice::get_products_clients');

$routes->get('/products', 'Products::index');
$routes->post('/products/save_product', 'Products::save_product');
$routes->post('/products/get_table_products', 'Products::get_table_products');
$routes->post('/products/edit_product', 'Products::edit_product');

$routes->get('/clients', 'Clients::index');
$routes->post('/clients/save_client', 'Clients::save_client');
$routes->post('/clients/get_table_clients', 'Clients::get_table_clients');
$routes->post('/clients/edit_client', 'Clients::edit_client');


