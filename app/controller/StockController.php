<?php
// Stock controller
namespace Controller;

use Entity\Stock;
use Entity\Product;
use Entity\Store;

class StockController {
    private $entityManager;

    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    // Add a new stock
    public function addStock() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!isset($_POST['productId']) || !isset($_POST['quantity']) || !isset($_POST['storeId'])) {
                  echo json_encode(['error' => 'Missing required fields']);
                return;
            }                

            $productId = $_POST['productId'];
            $quantity = $_POST['quantity'];
            $storeId = $_POST['storeId'];

            $product = $this->entityManager->getRepository(Product::class)->find($productId);
            $store = $this->entityManager->getRepository(Store::class)->find($storeId);

            $stock = new Stock();
            $stock->setProduct($product);
            $stock->setQuantity($quantity);
            $stock->setStore($store);

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
    public function updateStock($params) {
        $stockId = $params['stockId'];
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            parse_str(file_get_contents('php://input'), $_PUT);
    
            $stock = $this->entityManager->getRepository(Stock::class)->find($stockId);
    
            if (!$stock) {
                echo json_encode(['error' => 'Stock not found']);
                return;
            }
    
            if (isset($_PUT['quantity'])) {
                $stock->setQuantity($_PUT['quantity']);
            }
    
            if (isset($_PUT['productId'])) {
                $product = $this->entityManager->getRepository(Product::class)->find($_PUT['productId']);
                $stock->setProduct($product);
            }
    
            if (isset($_PUT['storeId'])) {
                $store = $this->entityManager->getRepository(Store::class)->find($_PUT['storeId']);
                $stock->setStore($store);
            }
    
            $this->entityManager->persist($stock);
            $this->entityManager->flush();
    
            echo json_encode(['success' => 'Stock updated']);
            return $stock;
        } else {
            echo json_encode(['error' => 'Invalid request']);
            return;
        }
    }

    // Delete a stock
    public function deleteStock($params) {
        $stockId = $params['stockId'];
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $stock = $this->entityManager->getRepository(Stock::class)->find($stockId);
    
            if (!$stock) {
                echo json_encode(['error' => 'Stock not found']);
                return;
            }
    
            $this->entityManager->remove($stock);
            $this->entityManager->flush();
    
            echo json_encode(['success' => 'Stock deleted']);
            return;
        } else {
            echo json_encode(['error' => 'Invalid request']);
            return;
        }
    }
}
?>