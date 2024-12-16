<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\MovieRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category')]
final class CategoryController extends AbstractController
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    #[Route(path: '/{slug}', name: 'app_category_show', methods: ['GET'])]
    public function view(
        #[MapEntity(mapping: ['slug' => 'slug'])] Category $category,
        MovieRepository $movieRepository,
        Request $request,
    ): Response {
        return $this->render('app/category.html.twig', [
            'category' => $category,
            'categories' => $this->categoryRepository->findAll(),
        ]);
    }
}
