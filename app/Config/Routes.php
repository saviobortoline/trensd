<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// FRONTEND ROUTES
$routes->get('/', 'Home::index');
$routes->get('/sobre-nos', 'Home::about');
$routes->get('/politica-devolucao', 'Home::refundPolicy');
$routes->get('/politica-privacidade', 'Home::privacyPolicy');
$routes->get('/contato', 'Home::contact');
$routes->post('/contato/enviar', 'Home::sendContact');
$routes->get('/loja', 'Products::index');
$routes->get('/buscar', 'Products::search');
$routes->get('/buscar/sugestoes', 'Products::suggestions');
$routes->get('/categoria/(:segment)', 'Products::category/$1');
$routes->get('/produto/(:num)', 'Products::detail/$1');

// ADMIN ROUTES
$routes->get('/admin/login', 'Admin::login');
$routes->post('/admin/login', 'Admin::doLogin');
$routes->get('/admin/logout', 'Admin::logout');
$routes->get('/admin/dashboard', 'Admin::dashboard');

// Produtos
$routes->get('/admin/products', 'Admin::products');
$routes->get('/admin/products/create', 'Admin::createProduct');
$routes->post('/admin/products/store', 'Admin::storeProduct');
$routes->get('/admin/products/(:num)/edit', 'Admin::editProduct/$1');
$routes->post('/admin/products/(:num)/update', 'Admin::updateProduct/$1');
$routes->delete('/admin/products/(:num)/delete', 'Admin::deleteProduct/$1');

// Categorias
$routes->get('/admin/categories', 'Admin::categories');
$routes->get('/admin/categories/create', 'Admin::createCategory');
$routes->post('/admin/categories/store', 'Admin::storeCategory');
$routes->get('/admin/categories/(:num)/edit', 'Admin::editCategory/$1');
$routes->post('/admin/categories/(:num)/update', 'Admin::updateCategory/$1');
$routes->delete('/admin/categories/(:num)/delete', 'Admin::deleteCategory/$1');
