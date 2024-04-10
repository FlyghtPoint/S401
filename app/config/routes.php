<?php
require_once __DIR__.'/../bootstrap.php';

use App\Controller\StoreController;
use App\Controller\ProductController;

$storeController = new StoreController($entityManager);
$productController = new ProductController($entityManager);

return [
    // Front office routes
    [
        'method' => 'GET',
        'path' => '/S401/stores',
        'controller' => $storeController,
        'action' => 'getAllStores',
    ],
    // '' => [
    //     'controller' => 'FrontController',
    //     'action' => 'index',
    // ],
    [
        'method' => 'GET',
        'path' => '/S401/products',
        'controller' => $productController,
        'action' => 'getAllProducts',
    ],
    // 'product/{id}' => [
    //     'controller' => 'FrontController',
    //     'action' => 'productDetails',
    // ],

    // Back office routes
    // 'admin' => [
    //     'controller' => 'BackController',
    //     'action' => 'dashboard',
    // ],
    // 'admin/products' => [
    //     'controller' => 'BackController',
    //     'action' => 'productsManagement',
    // ],
    // 'admin/users' => [
    //     'controller' => 'BackController',
    //     'action' => 'usersManagement',
    // ],

    // Auth routes
    // 'login' => [
    //     'controller' => 'AuthController',
    //     'action' => 'login',
    // ],
    // 'logout' => [
    //     'controller' => 'AuthController',
    //     'action' => 'logout',
    // ],
    // 'register' => [
    //     'controller' => 'AuthController',
    //     'action' => 'register',
    // ],
];
?>