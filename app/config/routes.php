<?php
require_once __DIR__.'/../bootstrap.php';

use App\Controller\StoreController;
use App\Controller\ProductController;
use App\Controller\EmployeeController;

$storeController = new StoreController($entityManager);
$productController = new ProductController($entityManager);
$employeeController = new EmployeeController($entityManager);

return [
    // Front office routes
    [
        'method' => 'GET',
        'path' => '/S401/stores',
        'controller' => $storeController,
        'action' => 'getAllStores',
    ],
    [
        'method' => 'GET',
        'path' => '/S401/products',
        'controller' => $productController,
        'action' => 'getAllProducts',
    ],
    [
        'method' => 'GET',
        'path' => '/S401/employees',
        'controller' => $employeeController,
        'action' => 'getAllEmployees',
    ],
    [
        'method' => 'GET',
        'path' => '/S401/stores/(?P<storeId>\d+)/employees',
        'controller' => $employeeController,
        'action' => 'getEmployeesFromStore',
    ],
    // '' => [
    //     'controller' => 'FrontController',
    //     'action' => 'index',
    // ],

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