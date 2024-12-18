<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Movie;
use App\Repository\CategoryRepository;
use App\Repository\MovieRepository;
use App\Repository\PlaylistRepository;
use App\Repository\PlaylistSubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class MediaController extends AbstractController
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    #[Route(path: '/discover', name: 'app_discover')]
    public function discover(): Response
    {
        return $this->render('app/media/discover.html.twig', [
            'categories' => $this->categoryRepository->findAll(),
        ]);
    }

    #[Route(path: '/category/{slug}', name: 'app_category_show', methods: ['GET'])]
    public function category(
        Category $category,
        MovieRepository $movieRepository,
        Request $request,
    ): Response {
        return $this->render('app/media/category.html.twig', [
            'category' => $category,
            'categories' => $this->categoryRepository->findAll(),
        ]);
    }

    #[Route('/playlists', name: 'app_playlist_index')]
    public function playlists(
        PlaylistSubscriptionRepository $playlistSubscriptionRepository,
        PlaylistRepository $playlistRepository,
        Request $request,
    ): Response {
        $id = $request->query->get('playlist', null);
        $selectedPlaylist = $id ? $playlistRepository->find($id) : null;

        return $this->render('app/media/playlists.html.twig', [
            'playlists' => $playlistRepository->findAll(),
            'subscribedPlaylists' => $playlistSubscriptionRepository->findBy(['subscriber' => $this->getUser()]),
            'selectedPlaylist' => $selectedPlaylist,
        ]);
    }

    #[Route(path: '/movie/{id}', name: 'app_movie_show')]
    public function movie(Movie $movie): Response
    {
        return $this->render('app/media/movie.html.twig', [
            'movie' => $movie
        ]);
    }
}
