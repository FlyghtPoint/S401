<?php
// Employee controller
namespace Controller;

use Entity\Employee;
use Entity\Store;
use Repository\EmployeeRepository;

class EmployeeController {
    private $entityManager;

    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    // API key
    const API_KEY = 'e8f1997c763';

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

    // Add a new employee to any store
    public function addEmployee() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['role']) || !isset($_POST['storeId'])) {
                echo json_encode(['error' => 'Missing required fields']);
                return;
            }

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $storeId = $_POST['storeId'];

            $store = $this->entityManager->getRepository(Store::class)->find($storeId);

            if (!$store) {
                echo json_encode(['error' => 'Store not found']);
                return;
            }

            $employee = new Employee();
            $employee->setEmployeeName($name);
            $employee->setEmployeeEmail($email);
            // Hash the password before storing it
            $employee->setEmployeePassword(password_hash($password, PASSWORD_DEFAULT));
            $employee->setEmployeeRole($role);
            $employee->setStore($store);

            $this->entityManager->persist($employee);
            $this->entityManager->flush();

            echo json_encode(['success' => 'Employee added']);
            return $employee;
        } else {
            echo json_encode(['error' => 'Invalid request']);
            return;
        }
    }

    // Add a new employee from the chief store
    public function addEmployeeToStore() {
        $headers = apache_request_headers();
        if (!isset($headers['Authorization']) || $headers['Authorization'] !== 'Bearer '.self::API_KEY) {
            echo json_encode(['error' => 'Invalid API key']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['chiefId']) || !isset($_POST['employeeName']) || !isset($_POST['employeeEmail']) || !isset($_POST['employeePassword'])) {
                echo json_encode(['error' => 'Missing required fields']);
                return;
            }

            $chiefId = $_POST['chiefId'];
            $employeeName = $_POST['employeeName'];
            $employeeEmail = $_POST['employeeEmail'];
            $employeePassword = password_hash($_POST['employeePassword'], PASSWORD_DEFAULT);

            $chief = $this->entityManager->getRepository(Employee::class)->find($chiefId);
            if (!$chief || $chief->getEmployeeRole() !== 'chief') {
                echo json_encode(['error' => 'Chief not found']);
                return;
            }

            $store = $chief->getStore();
            if (!$store) {
                echo json_encode(['error' => 'Chief has no store']);
                return;
            }

            $employee = new Employee();
            $employee->setEmployeeName($employeeName);
            $employee->setEmployeeEmail($employeeEmail);
            $employee->setEmployeePassword($employeePassword);
            $employee->setStore($store);
            $employee->setEmployeeRole('employee');

            $this->entityManager->persist($employee);
            $this->entityManager->flush();

            echo json_encode(['success' => 'Employee added to store']);
            return $employee;
        } else {
            echo json_encode(['error' => 'Invalid request']);
            return;
        }
    }

    // Modify login informations
    public function updateEmployeeLogin($params) {
        $employeeId = $params['employeeId'];
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
            echo json_encode(['error' => 'Invalid request']);
            return;
        }
        parse_str(file_get_contents('php://input'), $_PUT);
        // Find the employee by ID
        $employee = $this->entityManager->getRepository(Employee::class)->find($employeeId);

        // If the employee does not exist, return an error
        if (!$employee) {
            echo json_encode(['error' => 'Employee not found']);
            return;
        }

        $oldPassword = $employee->getEmployeePassword();

        // Update the employee's login information
        if (isset($_PUT['newEmail']) && isset($_PUT['newPassword'])) {
            $newEmail = $_PUT['newEmail'];
            $newPassword = password_hash($_PUT['newPassword'], PASSWORD_DEFAULT);
            if ($newPassword === $oldPassword) {
                echo json_encode(['error' => 'New password must be different from the old one']);
            }
            $employee->setEmployeeEmail($newEmail);
            $employee->setEmployeePassword($newPassword);
        } else {
            echo json_encode(['error' => 'Missing required fields']);
            return;
        }

        // Persist the changes and flush
        $this->entityManager->persist($employee);
        $this->entityManager->flush();

        echo json_encode(['success' => 'Employee login information updated']);
        return $employee;
    }
}
?>