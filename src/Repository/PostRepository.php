<?php

namespace App\Repository;

use App\Entity\Post;
use App\Exception\ObjectNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function getByUuid(string $uuid): Post
    {
        $post = $this->findOneBy(['uuid' => $uuid]);

        if (!$post instanceof Post) {
            throw new ObjectNotFoundException();
        }

        return $post;
    }

    public function add(Post $entity): void
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }
}
