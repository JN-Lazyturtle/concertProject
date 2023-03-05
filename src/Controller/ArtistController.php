<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/artists/{id}', name: 'artist_fiche', requirements: ['id' => '\d+'])]
    public function artist(ArtistRepository $artistRepository, int $id): Response
    {

        $artist = $artistRepository->find($id);
        return $this->render('artist/artist.html.twig', [
            'artist' => $artist,
        ]);
    }

    #[Route('/artists/admin', name: 'artists_admin')]
    public function manageArtist(ArtistRepository $artistRepository): Response
    {
        $artists = $artistRepository->findAll();
        return $this->render('artist/manage.html.twig', [
            'artistList' => $artists,
        ]);
    }

    #[Route('/artists/create/admin', name: 'artist_create')]
    public function createArtist(Request $request, EntityManagerInterface $manager): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $artist = $form->getData();

            $manager->persist($artist);
            $manager->flush();

            return $this->redirectToRoute('artists_admin');
        }

        return $this->render('artist/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/artists/delete/{id}/admin', name: 'artist_delete')]
    public function deleteArtist(Request $request, EntityManagerInterface $manager, Artist $artist): Response
    {
        $manager->remove($artist);
        $manager->flush();

        return $this->redirectToRoute('artists_admin');
    }

    #[Route('/artists/update/{id}/admin', name: 'artist_update')]
    public function updateArtist(Request $request, EntityManagerInterface $manager, Artist $artist): Response
    {
        $form = $this->createForm(ArtistType::class, $artist);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $artist = $form->getData();

            $manager->persist($artist);
            $manager->flush();

            return $this->redirectToRoute('artists_admin');
        }

        return $this->render('artist/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

}