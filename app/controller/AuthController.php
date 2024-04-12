<?php
// public function authenticate($email, $password) {
//     // Récupérer l'employé par email
//     $employee = $this->entityManager->getRepository(Employee::class)->findOneBy(['email' => $email]);

//     if (!$employee) {
//         echo json_encode(['error' => 'No user found with this email']);
//         return;
//     }

//     // Vérifier le mot de passe
//     if (password_verify($password, $employee->getEmployeePassword())) {
//         echo json_encode(['success' => 'Authentication successful']);
//         return $employee;
//     } else {
//         echo json_encode(['error' => 'Invalid password']);
//         return;
//     }
// }
?>