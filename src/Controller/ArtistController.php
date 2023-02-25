<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{
    #[Route('/artists', name: 'artists_list')]
    public function index(ArtistRepository $artistRepository): Response
    {
        $artistList = $artistRepository->findAll();
        return $this->render('artist/index.html.twig', [
            'artistList' => $artistList,
        ]);
    }

    #[Route('/artists/{id}', name: 'artist_fiche')]
    public function artist(ArtistRepository $artistRepository, int $id): Response
    {

        $artist = $artistRepository->find($id);
        return $this->render('artist/artist.html.twig', [
            'artist' => $artist,
        ]);
    }
}