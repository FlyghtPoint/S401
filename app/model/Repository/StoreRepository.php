<?php
// model/Repository/StoreRepository.php
namespace Repository;

use Doctrine\ORM\EntityRepository;
use Entity\Store;

class StoreRepository extends EntityRepository
{
    // Get all stores
    public function getAllStores()
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder()
            ->select('s')
            ->from(Store::class, 's');

        $query = $queryBuilder->getQuery();

        return $query->getResult();
    }
}
?>