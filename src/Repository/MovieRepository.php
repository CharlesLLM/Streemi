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
            ->orderBy('m.releaseDate', 'DESC')
            ->where(':category MEMBER OF m.categories')
            ->setParameter('category', $category->getId(), UuidType::NAME)
        ;

        if ($limit) {
            $qb->setMaxResults($limit);
        }

        return $qb;
    }

    public function findByCategory(Category $category, ?int $limit = null): array
    {
        return $this->queryByCategory($category, $limit)->getQuery()->getResult();
    }

    /**
     * Check if there are more movies of the given category to retrieve.
     *
     * @param Category $category The category to filter by
     * @param int      $page     The page number
     * @param int      $limit    The number of items per page
     *
     * @return bool True if there are more items, false otherwise
     */
    public function hasMore(Category $category, int $page, int $limit): bool
    {
        $result = $this->queryByCategory($category)
            ->setFirstResult($page * $limit)
            ->getQuery()
            ->getResult();

        return \count($result) > 0;
    }
}
