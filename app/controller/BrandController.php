<?php
// Brand controller
namespace App\Controller;

use Entity\Brand;
use Entity\Product;
// use Repository\BrandRepository;

class BrandController {
    private $entityManager;

    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    // Add a new brand
    public function addBrand() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['brandName'])) {
            $brandName = $_POST['brandName'];

            $brand = new Brand();
            $brand->setBrandName($brandName);

            $this->entityManager->persist($brand);
            $this->entityManager->flush();

            return $brand;
        } else {
            echo json_encode(['error' => 'Invalid request']);
            return;
        }
    }

    // Update a brand
    public function updateBrand($params) {
        $brandId = $params['brandId'];
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            parse_str(file_get_contents('php://input'), $_PUT);

            if (isset($_PUT['brandName'])) {
                $brandName = $_PUT['brandName'];

                $brand = $this->entityManager->getRepository(Brand::class)->find($brandId);
                $brand->setBrandName($brandName);
    
                $this->entityManager->flush();
    
                echo json_encode(['success' => 'Brand updated']);
                return $brand;
            } else {
                echo json_encode(['error' => 'Brand name is required']);
                return;
            }
        } else {
            echo json_encode(['error' => 'Invalid request method']);
            return;
        }
    }

    // Delete a brand
    public function deleteBrand($params) {
        $brandId = $params['brandId'];
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $brand = $this->entityManager->getRepository(Brand::class)->find($brandId);

            if (!$brand) {
                echo json_encode(['error' => 'Brand not found']);
                return;
            }

            $this->entityManager->remove($brand);
            $this->entityManager->flush();

            echo json_encode(['success' => 'Brand deleted']);
        } else {
            echo json_encode(['error' => 'Invalid request method']);
            return;
        }
    }
}
?>