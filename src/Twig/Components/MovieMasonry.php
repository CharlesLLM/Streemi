<?php

namespace App\Twig\Components;

use App\Entity\Category;
use App\Repository\MovieRepository;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class MovieMasonry
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public ?Category $category = null;

    #[LiveProp(writable: true)]
    public int $limit = 10;

    public function __construct(private MovieRepository $movieRepository)
    {
    }

    public function getMovies(): array
    {
        return $this->movieRepository->findByCategory($category, $this->limit);
    }

    #[LiveAction]
    public function loadMore(): void
    {
        $this->limit += 10;
    }
}
