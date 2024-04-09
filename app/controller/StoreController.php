<?php
// Store controller
require __DIR__ . '/../bootstrap.php';

use Entity\Store;
use Repository\StoreRepository;

$storeRepository = $entityManager->getRepository(Store::class);

// Get all stores
$stores = $storeRepository->getAllStores();
foreach ($stores as $store) {
    echo $store . "<br>";
}
// echo "Hello, World!";

