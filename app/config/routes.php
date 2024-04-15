<?php
require_once __DIR__.'/../bootstrap.php';

use App\Controller\BrandController;
use App\Controller\CategoryController;
use App\Controller\EmployeeController;
use App\Controller\ProductController;
use App\Controller\StockController;
use App\Controller\StoreController;

$brandController = new BrandController($entityManager);
$categoryController = new CategoryController($entityManager);
$employeeController = new EmployeeController($entityManager);
$productController = new ProductController($entityManager);
$stockController = new StockController($entityManager);
$storeController = new StoreController($entityManager);

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

    //? Employee

    // 'it/employees/add'
    [
        'method' => 'POST',
        'path' => '/S401/employees/add',
        'controller' => $employeeController,
        'action' => 'addEmployee',
    ],
    // 'chief/employees/add'
    [
        'method' => 'POST',
        'path' => '/S401/chief/employees/add',
        'controller' => $employeeController,
        'action' => 'addEmployeeToStore',
    ],
    // 'employees/edit/{id}
    [
        'method' => 'PUT',
        'path' => '/S401/employees/edit/(?P<employeeId>\d+)',
        'controller' => $employeeController,
        'action' => 'updateEmployeeLogin',
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

    //? Stock

    // 'admin/stocks/add'
    [
        'method' => 'POST',
        'path' => '/S401/stocks/add',
        'controller' => $stockController,
        'action' => 'addStock',
    ],
    // 'admin/stocks/edit/{id}'
    [
        'method' => 'PUT',
        'path' => '/S401/stocks/edit/(?P<stockId>\d+)',
        'controller' => $stockController,
        'action' => 'updateStock',
    ],
    // 'admin/stocks/delete/{id}'
    [
        'method' => 'DELETE',
        'path' => '/S401/stocks/delete/(?P<stockId>\d+)',
        'controller' => $stockController,
        'action' => 'deleteStock',
    ],

    //? Store

    // 'admin/stores/add'
    [
        'method' => 'POST',
        'path' => '/S401/stores/add',
        'controller' => $storeController,
        'action' => 'addStore',
    ],
    // 'admin/stores/edit/{id}'
    [
        'method' => 'PUT',
        'path' => '/S401/stores/edit/(?P<storeId>\d+)',
        'controller' => $storeController,
        'action' => 'updateStore',
    ],
    // 'admin/stores/delete/{id}'
    [
        'method' => 'DELETE',
        'path' => '/S401/stores/delete/(?P<storeId>\d+)',
        'controller' => $storeController,
        'action' => 'deleteStore',
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