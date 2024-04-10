<?php
// model/Repository/ProductRepository.php
namespace Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    // Get all products
    public function getAllProducts()
    {
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult();
    }
}
?>