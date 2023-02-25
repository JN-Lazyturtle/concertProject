<?php

namespace App\Controller;

use App\Entity\Concert;
use App\Form\ConcertType;
use App\Repository\ConcertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

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

    #[Route('/concerts/admin', name: 'concert_admin')]
    public function manageConcert(ConcertRepository $concertRepository): Response
    {
        $concerts = $concertRepository->findAll();
        return $this->render('concert/manage.html.twig', [
            'concertList' => $concerts,
        ]);
    }

    #[Route('/concerts/create', name: 'concert_create')]
    public function createConcert(Request $request): Response
    {
        $concert = new Concert();
        $form = $this->createForm(ConcertType::class, $concert);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $concert = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concert);
            $entityManager->flush();

            return $this->redirectToRoute('concert_success');
        }

        return $this->render('concert/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}