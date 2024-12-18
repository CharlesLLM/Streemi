<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DefaultController extends AbstractController
{
    #[Route(path: '/', name: 'admin_dashboard', methods: ['GET'])]
    public function index(MovieRepository $movieRepository): Response
    {
        return $this->render('app/home/index.html.twig', [
            'movies' => $movieRepository->findBy([], ['score' => 'DESC'], 15),
        ]);
    }
}
