<?php
// Product controller
namespace Controller;

use Entity\Product;
use Entity\Brand;
use Entity\Category;
use Entity\Stock;
use Repository\ProductRepository;

class ProductController {
    private $entityManager;

    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    // Get all products
    public function getAllProducts() {
        $productsRepository = $this->entityManager->getRepository(Product::class);
        $products = $productsRepository->getAllProducts();

        $productData = [];

        foreach ($products as $product) {
            $productData[] = [
                'id' => $product->getProductId(),
                'name' => $product->getProductName(),
                'brand' => $product->getBrand()->getBrandName(),
                'category' => $product->getCategory()->getCategoryName(),
                'year' => $product->getModelYear(),
                'price' => $product->getListPrice(),
                'stock' => array_map(function($stock) { return $stock->jsonSerialize(); }, $product->getStocks()->toArray()),
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($productData);
    }

    // Add a new product
    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productName'])) {
            $productName = $_POST['productName'];
            $brandId = $_POST['brandId'];
            $categoryId = $_POST['categoryId'];
            $modelYear = $_POST['modelYear'];
            $listPrice = $_POST['listPrice'];

            $product = new Product();
            $product->setProductName($productName);
            $product->setModelYear($modelYear);
            $product->setListPrice($listPrice);

            $brand = $this->entityManager->getRepository(Brand::class)->find($brandId);
            $product->setBrand($brand);

            $category = $this->entityManager->getRepository(Category::class)->find($categoryId);
            $product->setCategory($category);

            $this->entityManager->persist($product);
            $this->entityManager->flush();

            echo json_encode(['success' => 'Product added']);
            return $product;
        } else {
            echo json_encode(['error' => 'Invalid request']);
            return;
        }
    }

    // Update a product
    public function updateProduct($params) {
        $productId = $params['productId'];
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            parse_str(file_get_contents('php://input'), $_PUT);
    
            $product = $this->entityManager->getRepository(Product::class)->find($productId);
    
            if (!$product) {
                echo json_encode(['error' => 'Product not found']);
                return;
            }
    
            if (isset($_PUT['productName'])) {
                $product->setProductName($_PUT['productName']);
            }
    
            if (isset($_PUT['brandId'])) {
                $brand = $this->entityManager->getRepository(Brand::class)->find($_PUT['brandId']);
                $product->setBrand($brand);
            }
    
            if (isset($_PUT['categoryId'])) {
                $category = $this->entityManager->getRepository(Category::class)->find($_PUT['categoryId']);
                $product->setCategory($category);
            }
    
            if (isset($_PUT['modelYear'])) {
                $product->setModelYear($_PUT['modelYear']);
            }
    
            if (isset($_PUT['listPrice'])) {
                $product->setListPrice($_PUT['listPrice']);
            }
    
            $this->entityManager->flush();
    
            echo json_encode(['success' => 'Product updated']);
            return $product;
        } else {
            echo json_encode(['error' => 'Invalid request method']);
            return;
        }
    }

    // Delete a product
    public function deleteProduct($params) {
        $productId = $params['productId'];
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $product = $this->entityManager->getRepository(Product::class)->find($productId);
            
            if (!$product) {
                echo json_encode(['error' => 'Product not found']);
                return;
            }

            $this->entityManager->remove($product);
            $this->entityManager->flush();

            echo json_encode(['success' => 'Product deleted']);
        } else {
            echo json_encode(['error' => 'Invalid request method']);
            return;
        }
    }
}
?>
