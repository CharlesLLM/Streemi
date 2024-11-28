<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Types\UuidType;

class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function queryByCategory(Category $category, ?int $limit = null): QueryBuilder
    {
        $qb = $this->createQueryBuilder('m')
            ->where(':category MEMBER OF m.categories')
            ->setParameter('category', $category->getId(), UuidType::NAME)
            ->orderBy('m.releaseDate', 'DESC');

        if ($limit) {
            $qb->setMaxResults($limit);
        }

        return $qb;
    }

    public function findByCategory(Category $category, ?int $limit = null): array
    {
        return $this->queryByCategory($category, $limit)->getQuery()->getResult();
    }
}
