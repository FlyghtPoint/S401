<?php
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/x-www-form-urlencoded");
// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// header("Access-Control-Max-Age: 3600");
// http_response_code(200);
// bootstrap.php

require_once __DIR__ . "/../vendor/autoload.php";

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

// Create a simple "default" Doctrine ORM configuration for Attributes
$paths = array(__DIR__."/Model/Entity");
$isDevMode = true;

$config = ORMSetup::createAnnotationMetadataConfiguration($paths,$isDevMode);


// configuring the database connection
$connection = DriverManager::getConnection([
    'dbname' => 'lefevre216_2',
    'user' => 'lefevre216',
    'password' => 'iadiToom3iechohp',
    'host' => 'mysql.info.unicaen.fr:3306',
    'driver' => 'pdo_mysql',
], $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);

?>