<?php
// Product controller
namespace App\Controller;

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
            // var_dump($product->getStocks());s
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
}
?>
