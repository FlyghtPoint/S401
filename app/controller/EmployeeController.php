<?php
// Employee controller
namespace App\Controller;

use Entity\Employee;
use Entity\Store;
use Repository\EmployeeRepository;

class EmployeeController {
    private $entityManager;

    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    // Get all employees
    public function getAllEmployees() {
        $employees = $this->entityManager->getRepository(Employee::class)->findAll();
        $employeesData = [];

        foreach ($employees as $employee) {
            $employeesData[] = $employee->jsonSerialize();
        }

        header('Content-Type: application/json');
        echo json_encode($employeesData);
    }

    // Get employees from his store
    public function getEmployeesFromStore($params) {
        $storeId = $params['storeId'];
        $store = $this->entityManager->getRepository(Store::class)->find($storeId);

        if (!$store) {
            // Handle the case where the store was not found
            echo json_encode(['error' => 'Store not found']);
            return;
        }

        $employees = $this->entityManager->getRepository(Employee::class)->findBy(['store' => $store]);
        $employeesData = [];

        foreach ($employees as $employee) {
            $employeesData[] = $employee->jsonSerialize();
        }

        header('Content-Type: application/json');
        echo json_encode($employeesData);
    }
}
?>