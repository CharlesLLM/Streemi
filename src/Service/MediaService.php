<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\MovieRepository;
use App\Repository\SerieRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

final class MediaService
{
    public function __construct(
        private readonly MovieRepository $movieRepository,
        private readonly SerieRepository $serieRepository,
        private readonly PaginatorInterface $paginator,
    ) {
    }

    /**
     * Use pagination to retrieve a list of media items.
     * Comment : Very dirty way because we dont actually use pagination...
     *
     * @param string   $entity   The class of media to retrieve (e.g. 'movie' or 'serie')
     * @param int      $page     The page number
     * @param int      $limit    The number of items per page
     * @param Category $category The category to filter by
     */
    public function paginate(string $entity, int $page, int $limit, Category $category): iterable
    {
        $repository = $this->matchRepository($entity);
        $query = $repository->queryByCategory($category);

        return $this->paginator->paginate($query, $page, $limit);
    }

    public function formatForDisplay(PaginationInterface $results): iterable
    {
        $items = [];
        foreach ($results->getItems() as $item) {
            $items[] = [
                'id' => $item->getId(),
                'title' => $item->getTitle(),
                'releaseDate' => $item->getReleaseDate(),
                'coverImage' => $item->getCoverImage(),
            ];
        }

        return $items;
    }

    public function matchRepository(string $entity): object
    {
        return match ($entity) {
            'movie' => $this->movieRepository,
            'serie' => $this->serieRepository,
            default => throw new \InvalidArgumentException('Invalid entity class'),
        };
    }
}
