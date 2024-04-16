<?php
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