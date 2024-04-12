<?php
// Stock controller
namespace App\Controller;

use Entity\Stock;
use Entity\Product;

class StockController {
    private $entityManager;

    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    // Add a new stock
    public function addStock() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productId']) && isset($_POST['quantity'])) {
            $productId = $_POST['productId'];
            $quantity = $_POST['quantity'];

            $product = $this->entityManager->getRepository(Product::class)->find($productId);

            $stock = new Stock();
            $stock->setProduct($product);
            $stock->setQuantity($quantity);

            $this->entityManager->persist($stock);
            $this->entityManager->flush();

            echo json_encode(['success' => 'Stock added']);
            return $stock;
        } else {
            echo json_encode(['error' => 'Invalid request']);
            return;
        }
    }

    // Update a stock
    public function updateStock($params) {}

    // Delete a stock
    public function deleteStock($params) {}
}
?>