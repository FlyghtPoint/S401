<?php
// Category controller
namespace Controller;

use Entity\Category;
use Entity\Product;

class CategoryController {
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

    // Add a new category
    public function addCategory() {
        if (!$this->verifyApiKey()) {
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoryName'])) {
            $categoryName = $_POST['categoryName'];

            $category = new Category();
            $category->setCategoryName($categoryName);

            $this->entityManager->persist($category);
            $this->entityManager->flush();

            echo json_encode(['success' => 'Category added']);
            return $category;
        } else {
            echo json_encode(['error' => 'Invalid request']);
            return;
        }
    }

    // Update a category
    public function updateCategory($params) {
        if (!$this->verifyApiKey()) {
            return;
        }

        $categoryId = $params['categoryId'];
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            parse_str(file_get_contents('php://input'), $_PUT);

            if (isset($_PUT['categoryName'])) {
                $categoryName = $_PUT['categoryName'];

                $category = $this->entityManager->getRepository(Category::class)->find($categoryId);
                $category->setCategoryName($categoryName);
    
                $this->entityManager->flush();
    
                echo json_encode(['success' => 'Category updated']);
                return $category;
            } else {
                echo json_encode(['error' => 'Category name is required']);
                return;
            }
        } else {
            echo json_encode(['error' => 'Invalid request method']);
            return;
        }
    }

    // Delete a category
    public function deleteCategory($params) {
        if (!$this->verifyApiKey()) {
            return;
        }
        
        $categoryId = $params['categoryId'];
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $category = $this->entityManager->getRepository(Category::class)->find($categoryId);
            
            if (!$category) {
                echo json_encode(['error' => 'Category not found']);
                return;
            }

            $this->entityManager->remove($category);
            $this->entityManager->flush();

            echo json_encode(['success' => 'Category deleted']);
        } else {
            echo json_encode(['error' => 'Invalid request method']);
            return;
        }
    }
}
?>