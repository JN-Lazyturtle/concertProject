<?php

namespace App\Controller;

use App\Entity\Concert;
use App\Form\ConcertType;
use App\Repository\ConcertRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConcertController extends AbstractController
{
    #[Route('/', name: 'concerts_list')]
    public function index(ConcertRepository $concertRepository): Response
    {
        $concertList = $concertRepository->findAll();
        return $this->render('concert/index.html.twig', [
            'concertList' => $concertList,
        ]);
    }

    #[Route('/concerts/{id}', name: 'concert_details', requirements: ['id' => '\d+'])]
    public function concert(ConcertRepository $concertRepository, int $id): Response
    {
        $concert = $concertRepository->find($id);
        return $this->render('concert/concert.html.twig', [
            'concert' => $concert,
        ]);
    }

    #[Route('/concerts/admin', name: 'concerts_admin')]
    public function manageConcert(ConcertRepository $concertRepository): Response
    {
        $concerts = $concertRepository->findAll();
        return $this->render('concert/manage.html.twig', [
            'concertList' => $concerts,
        ]);
    }

    #[Route('/concerts/create', name: 'concert_create')]
    public function createConcert(Request $request, EntityManagerInterface $manager): Response
    {
        $concert = new Concert();
        $form = $this->createForm(ConcertType::class, $concert);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $concert = $form->getData();

            $manager->persist($concert);
            $manager->flush();

            return $this->redirectToRoute('concerts_admin');
        }

        return $this->render('concert/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/concerts/delete/{id}', name: 'concert_delete')]
    public function deleteConcert(Request $request, EntityManagerInterface $manager, Concert $concert): Response
    {
        $manager->remove($concert);
        $manager->flush();

        return $this->redirectToRoute('concerts_admin');
    }

    #[Route('/concerts/update/{id}', name: 'concert_update')]
    public function updateConcert(Request $request, EntityManagerInterface $manager, Concert $concert): Response
    {
        $form = $this->createForm(ConcertType::class, $concert);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $concert = $form->getData();

            $manager->persist($concert);
            $manager->flush();

            return $this->redirectToRoute('concerts_admin');
        }

        return $this->render('concert/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

}