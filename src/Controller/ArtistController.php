<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{
    #[Route('/artist', name: 'artist')]
    public function index(ArtistRepository $artistRepository): Response
    {
        $artistRepository->findAll();
        return $this->render('artist/index.html.twig', [
            'controller_name' => 'ArtistController',
        ]);
//        return $this->json([
//            'message' => 'Welcome to your new controller!',
//            'path' => 'src/Controller/ArtistController.php',
//        ]);
    }
}