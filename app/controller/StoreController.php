<?php
// Store controller
namespace App\Controller;

use Entity\Store;
use Entity\Stock;
use Entity\Employee;
// use Repository\StoreRepository;

class StoreController {
    private $entityManager;

    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    // Get all stores
    public function getAllStores() {
        $storeRepository = $this->entityManager->getRepository(Store::class);
        $stores = $storeRepository->getAllStores();

        $storeData = [];
        foreach ($stores as $store) {
            $storeData[] = [
                'id' => $store->getStoreId(),
                'name' => $store->getStoreName(),
                'phone' => $store->getPhone(),
                'email' => $store->getEmail(),
                'street' => $store->getStreet(),
                'city' => $store->getCity(),
                'state' => $store->getState(),
                'zipcode' => $store->getZipCode(),
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($storeData);
    }

    // Add a new store
}
?>
