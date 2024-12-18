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
     * @param int      $page     The page number
     * @param int      $limit    The number of items per page
     * @param Category $category The category to filter by (may be null)
     *
     * @return bool True if there are more items, false otherwise
     */
    public function hasMore(int $page, int $limit, ?Category $category = null): bool
    {
        $qb = null !== $category
            ? $this->queryByCategory($category)
            : $this->createQueryBuilder('m')->orderBy('m.releaseDate', 'DESC');

        $result = $qb->setFirstResult($page * $limit)
            ->getQuery()
            ->getResult();

        return \count($result) > 0;
    }

    public function findRandom(?int $limit = null): array
    {
        $qb = $this->createQueryBuilder('m')
            ->where('m.title LIKE :query')
            ->setParameter('query', '%Harry Potter%') // ;)
            ->orderBy('RAND()');

        if (null !== $limit) {
            $qb->setMaxResults(3);
        }

        return $qb->getQuery()->getResult();
    }
}
