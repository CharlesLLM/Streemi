<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category')]
final class CategoryController extends AbstractController
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    #[Route(path: '/', name: 'app_category_index', methods: ['GET'])]
    public function index(MovieRepository $movieRepository): Response
    {
        return $this->render('app/category.html.twig', [
            'categories' => $this->categoryRepository->findAll(),
            'movies' => $movieRepository->findLastMovies(10),
        ]);
    }
}
