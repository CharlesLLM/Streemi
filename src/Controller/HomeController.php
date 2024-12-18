<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController
{
    // TODO : '/'
    #[Route(path: '/home', name: 'app_home', methods: ['GET'])]
    public function index(MovieRepository $movieRepository): Response
    {
        return $this->render('app/home/index.html.twig', [
            'movies' => $movieRepository->findBy([], ['score' => 'DESC'], 15),
        ]);
    }
}
