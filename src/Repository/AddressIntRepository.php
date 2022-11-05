<?php

namespace App\Repository;

use App\Entity\AddressInt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AddressInt>
 *
 * @method AddressInt|null find($id, $lockMode = null, $lockVersion = null)
 * @method AddressInt|null findOneBy(array $criteria, array $orderBy = null)
 * @method AddressInt[]    findAll()
 * @method AddressInt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddressIntRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AddressInt::class);
    }

    public function add(AddressInt $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
