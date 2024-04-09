<?php

namespace App\Controller;

use App\Model\Entity\Store;
use Doctrine\ORM\EntityManager;

class StoreController
{
    private $entityManager;

    public function handleRequest()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];

        switch ($requestMethod) {
            case 'GET':
                if ($requestUri === '/stores') {
                    return $this->getStores();
                }
                break;
            default:
                header('HTTP/1.1 405 Method Not Allowed');
                header('Allow: GET');
                break;
        }

        header('HTTP/1.1 404 Not Found');
    }

    public function getStores()
    {
        $stores = $this->entityManager->getRepository(Store::class)->findAll();

        $data = [];
        foreach ($stores as $store)
        {
            $data[] = 
            [
                'store_id' => $store->getStoreId(),
                'store_name' => $store->getStoreName(),
                'phone' => $store->getPhone(),
                'email' => $store->getEmail(),
                'street' => $store->getStreet(),
                'city' => $store->getCity(),
                'state' => $store->getState(),
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
?>