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
    public function addStock() {}

    // Update a stock
    public function updateStock() {}

    // Delete a stock
    public function deleteStock() {}
}
?>