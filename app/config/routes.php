<?php
require_once __DIR__.'/../bootstrap.php';

use App\Controller\StoreController;
use App\Controller\ProductController;
use App\Controller\EmployeeController;
use App\Controller\BrandController;
use App\Controller\CategoryController;

$storeController = new StoreController($entityManager);
$productController = new ProductController($entityManager);
$employeeController = new EmployeeController($entityManager);
$brandController = new BrandController($entityManager);
$categoryController = new CategoryController($entityManager);

return [

    //! Front office routes (public routes) : GET
    
    //? Store

    // 'stores'
    [
        'method' => 'GET',
        'path' => '/S401/stores',
        'controller' => $storeController,
        'action' => 'getAllStores',
    ],
    // 'store/{id}' 
    [
        'method' => 'GET',
        'path' => '/S401/stores/(?P<storeId>\d+)/employees',
        'controller' => $employeeController,
        'action' => 'getEmployeesFromStore',
    ],

    //? Product

    // 'products'
    [
        'method' => 'GET',
        'path' => '/S401/products',
        'controller' => $productController,
        'action' => 'getAllProducts',
    ],

    //? Employee

    // 'employees'
    [
        'method' => 'GET',
        'path' => '/S401/employees',
        'controller' => $employeeController,
        'action' => 'getAllEmployees',
    ],

    // '' => [
    //     'controller' => 'FrontController',
    //     'action' => 'index',
    // ],

    // 'product/{id}' => [
    //     'controller' => 'FrontController',
    //     'action' => 'productDetails',
    // ],

    //! Back office routes (private routes) : POST, PUT, DELETE

    //? Brand

    // 'admin/brands/add' 
    [
        'method' => 'POST',
        'path' => '/S401/brands',
        'controller' => $brandController,
        'action' => 'addBrand',
    ],
    // 'admin/brands/edit/{id}'
    [
        'method' => 'PUT',
        'path' => '/S401/brands/(?P<brandId>\d+)',
        'controller' => $brandController,
        'action' => 'updateBrand',
    ],
    // 'admin/brands/delete/{id}'
    [
        'method' => 'DELETE',
        'path' => '/S401/brands/(?P<brandId>\d+)',
        'controller' => $brandController,
        'action' => 'deleteBrand',
    ],

    // ? Category

    // 'admin/category/add'
    [
        'method' => 'POST',
        'path' => '/S401/categories',
        'controller' => $categoryController,
        'action' => 'addCategory',
    ],
    // 'admin/category/edit/{id}'
    [
        'method' => 'PUT',
        'path' => '/S401/categories/(?P<categoryId>\d+)',
        'controller' => $categoryController,
        'action' => 'updateCategory',
    ],
    // 'admin/category/delete/{id}'
    [
        'method' => 'DELETE',
        'path' => '/S401/categories/(?P<categoryId>\d+)',
        'controller' => $categoryController,
        'action' => 'deleteCategory',
    ],

    //? Product

    // 'admin/products/add'
    [
        'method' => 'POST',
        'path' => '/S401/products/add',
        'controller' => $productController,
        'action' => 'addProduct',
    ],
    // 'admin/products/edit/{id}'
    [
        'method' => 'PUT',
        'path' => '/S401/products/edit/(?P<productId>\d+)',
        'controller' => $productController,
        'action' => 'updateProduct',
    ],
    // 'admin/products/delete/{id}'
    [
        'method' => 'DELETE',
        'path' => '/S401/products/delete/(?P<productId>\d+)',
        'controller' => $productController,
        'action' => 'deleteProduct',
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