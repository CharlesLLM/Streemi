<?php

namespace App\Service;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

final class MediaService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly PaginatorInterface $paginator,
    ) {
    }

    /**
     * Use pagination to retrieve a list of media items.
     *
     * @param string   $entity   The class of media to retrieve (e.g. Movie::class)
     * @param int      $page     The page number
     * @param int      $limit    The number of items per page
     * @param Category $category The category to filter by
     */
    public function paginate(string $entity, int $page, int $limit, Category $category): iterable
    {
        if (!class_exists($entity)) {
            throw new \InvalidArgumentException(sprintf('The class "%s" does not exist.', $entity));
        }

        $repository = $this->entityManager->getRepository($entity);
        $query = $repository->queryByCategory($category);

        return $this->paginator->paginate($query, $page, $limit);
    }
}
