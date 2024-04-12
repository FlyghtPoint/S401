<?php
require_once __DIR__.'/../bootstrap.php';

use App\Controller\StoreController;
use App\Controller\ProductController;
use App\Controller\EmployeeController;
use App\Controller\BrandController;

$storeController = new StoreController($entityManager);
$productController = new ProductController($entityManager);
$employeeController = new EmployeeController($entityManager);
$brandController = new BrandController($entityManager);

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
    [
        'method' => 'POST',
        'path' => '/S401/brands',
        'controller' => $brandController,
        'action' => 'addBrand',
    ],
    [
        'method' => 'PUT',
        'path' => '/S401/brands/(?P<brandId>\d+)',
        'controller' => $brandController,
        'action' => 'updateBrand',
    ],
    [
        'method' => 'DELETE',
        'path' => '/S401/brands/(?P<brandId>\d+)',
        'controller' => $brandController,
        'action' => 'deleteBrand',
    ],
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