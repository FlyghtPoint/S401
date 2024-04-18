<?php
// Store controller
namespace Controller;

use Entity\Store;
use Entity\Stock;
use Entity\Employee;
// use Repository\StoreRepository;

class StoreController {
    private $entityManager;

    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    // API key
    const API_KEY = 'e8f1997c763';

    // Write a function to verify the API key
    public function verifyApiKey() {
        $headers = apache_request_headers();
        if (!isset($headers['Authorization']) || $headers['Authorization'] !== 'Bearer '.self::API_KEY) {
            echo json_encode(['error' => 'Invalid API key']);
            return false;
        }
        return true;
    }

    // Get all stores
    public function getAllStores() {
        $storeRepository = $this->entityManager->getRepository(Store::class);
        $stores = $storeRepository->findAll();

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
    public function addStore() {
        if (!$this->verifyApiKey()) {
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['storeName']) || !isset($_POST['phone']) || !isset($_POST['email']) || !isset($_POST['street']) || !isset($_POST['city']) || !isset($_POST['state']) || !isset($_POST['zipCode'])) {
                echo json_encode(['error' => 'Missing required fields']);
                return;
            }
        
            $storeName = $_POST['storeName'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $street = $_POST['street'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zipCode = $_POST['zipCode'];

            $store = new Store();
            $store->setStoreName($storeName);
            $store->setPhone($phone);
            $store->setEmail($email);
            $store->setStreet($street);
            $store->setCity($city);
            $store->setState($state);
            $store->setZipCode($zipCode);

            $this->entityManager->persist($store);
            $this->entityManager->flush();

            echo json_encode(['success' => 'Store added']);
            return $store;
        } else {
            echo json_encode(['error' => 'Invalid request']);
            return;
        }
    }

    // Update a store
    public function updateStore($params) {
        if (!$this->verifyApiKey()) {
            return;
        }

        $storeId = $params['storeId'];
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            parse_str(file_get_contents('php://input'), $_PUT);
    
            $store = $this->entityManager->getRepository(Store::class)->find($storeId);
    
            if (!$store) {
                echo json_encode(['error' => 'Store not found']);
                return;
            }
    
            if (isset($_PUT['storeName'])) {
                $store->setStoreName($_PUT['storeName']);
            }
    
            if (isset($_PUT['phone'])) {
                $store->setPhone($_PUT['phone']);
            }
    
            if (isset($_PUT['email'])) {
                $store->setEmail($_PUT['email']);
            }
    
            if (isset($_PUT['street'])) {
                $store->setStreet($_PUT['street']);
            }
    
            if (isset($_PUT['city'])) {
                $store->setCity($_PUT['city']);
            }
    
            if (isset($_PUT['state'])) {
                $store->setState($_PUT['state']);
            }
    
            if (isset($_PUT['zipCode'])) {
                $store->setZipCode($_PUT['zipCode']);
            }
    
            $this->entityManager->flush();
    
            echo json_encode(['success' => 'Store updated']);
            return $store;
        } else {
            echo json_encode(['error' => 'Invalid request']);
            return;
        }
    }

    // Delete a store
    public function deleteStore($params) {
        if (!$this->verifyApiKey()) {
            return;
        }
        
        $storeId = $params['storeId'];
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $store = $this->entityManager->getRepository(Store::class)->find($storeId);
    
            if (!$store) {
                echo json_encode(['error' => 'Store not found']);
                return;
            }
    
            $this->entityManager->remove($store);
            $this->entityManager->flush();
    
            echo json_encode(['success' => 'Store deleted']);
            return;
        } else {
            echo json_encode(['error' => 'Invalid request']);
            return;
        }
    }
}
?>
