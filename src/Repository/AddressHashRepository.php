<?php

namespace App\Repository;

use App\Entity\AddressHash;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AddressHash>
 *
 * @method AddressHash|null find($id, $lockMode = null, $lockVersion = null)
 * @method AddressHash|null findOneBy(array $criteria, array $orderBy = null)
 * @method AddressHash[]    findAll()
 * @method AddressHash[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddressHashRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AddressHash::class);
    }

    public function add(AddressHash $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
