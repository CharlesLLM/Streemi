<?php

namespace App\Twig\Components;

use App\Repository\MovieRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\ComponentToolsTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class RecommandationHeader
{
    use ComponentToolsTrait;
    use DefaultActionTrait;

    private const PER_PAGE = 3;

    public function __construct(private readonly MovieRepository $movieRepository)
    {
    }

    #[LiveAction]
    public function loadMore(): void
    {
        $this->movieRepository->findRandom(self::PER_PAGE);
    }

    public function getMovies(): array
    {
        return $this->movieRepository->findRandom(self::PER_PAGE);
    }
}
