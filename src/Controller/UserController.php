<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\ArtistRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user/{id}', name: 'user_account', requirements: ['id' => '\d+'])]
    public function index(UserRepository $userRepository, int $id): Response
    {
        $user = $userRepository->find($id);
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/user/update/{id}', name: 'user_update')]
    public function updateConcert(Request $request, EntityManagerInterface $manager, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('concerts_list');
        }

        return $this->render('user/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/user/{id}/addArtists/{artistId}', name: 'user_artists')]
    public function updateArtists(int $artistId, EntityManagerInterface $manager, int $id, UserRepository $userRepository, ArtistRepository $artistRepository): Response
    {
        $user = $userRepository->find($id);
        $artist = $artistRepository->find($artistId);
        $user->addArtist($artist);
        $manager->persist($user);
        $manager->flush();

        return $this->redirectToRoute('artist_fiche', ['id'=> $artist->getId()]);
    }

    #[Route('/user/{id}/deleteArtists/{artistId}', name: 'user_artist')]
    public function deleteArtist(int $artistId, EntityManagerInterface $manager, int $id, UserRepository $userRepository, ArtistRepository $artistRepository): Response
    {
        $user = $userRepository->find($id);
        $artist = $artistRepository->find($artistId);
        $user->removeArtist($artist);
        $manager->persist($user);
        $manager->flush();
        return $this->redirectToRoute('user_account', ['id'=> $user->getId()]);
    }
}
