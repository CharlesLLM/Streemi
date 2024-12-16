<?php

namespace App\Twig\Components;

use App\Entity\Category;
use App\Repository\MovieRepository;
use App\Service\MediaService;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentToolsTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class MovieMasonry
{
    use ComponentToolsTrait;
    use DefaultActionTrait;

    #[LiveProp]
    public Category $category;

    private const PER_PAGE = 3;

    #[LiveProp]
    public int $page = 1;

    public function __construct(
        private readonly MediaService $mediaService,
        private readonly MovieRepository $movieRepository,
    ) {
    }

    #[LiveAction]
    public function more(): void
    {
        ++$this->page;
    }

    public function hasMore(): bool
    {
        return $this->movieRepository->hasMore($this->category, $this->page, self::PER_PAGE);
    }

    public function getMovies(): iterable
    {
        $results = $this->mediaService->paginate('movie', $this->page, self::PER_PAGE, $this->category);

        return $this->mediaService->formatForDisplay($results);
    }
}
