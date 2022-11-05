<?php

namespace App\Repository;

use App\Entity\AddressUuid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AddressUuid>
 *
 * @method AddressUuid|null find($id, $lockMode = null, $lockVersion = null)
 * @method AddressUuid|null findOneBy(array $criteria, array $orderBy = null)
 * @method AddressUuid[]    findAll()
 * @method AddressUuid[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddressUuidRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AddressUuid::class);
    }

    public function add(AddressUuid $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
