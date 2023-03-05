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
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Constraints\DateTime;

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

    #[Route('/archives', name: 'concerts_archives')]
    public function archives(ConcertRepository $concertRepository): Response
    {
        $concertList = $concertRepository->findAll();
//        $archive = [];
//        foreach ($concertList as $key => $concert) {
//            if ($concert.getDateC() < date("Y-m-d H:i:s")){
//                $archive[] = $concert;
//            }
//        }
//        dump($archive);
//        die();
        return $this->render('concert/archive.html.twig', [
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

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/concerts/admin', name: 'concerts_admin')]
    public function manageConcert(ConcertRepository $concertRepository): Response
    {
        $concerts = $concertRepository->findAll();
        return $this->render('concert/manage.html.twig', [
            'concertList' => $concerts,
        ]);
    }

    #[IsGranted('ROLE_SUPER_ADMIN')]
    #[Route('/concerts/create/admin', name: 'concert_create')]
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

    #[IsGranted('ROLE_SUPER_ADMIN')]
    #[Route('/concerts/delete/{id}/admin', name: 'concert_delete')]
    public function deleteConcert(Request $request, EntityManagerInterface $manager, Concert $concert): Response
    {
        $manager->remove($concert);
        $manager->flush();

        return $this->redirectToRoute('concerts_admin');
    }

    #[IsGranted('ROLE_SUPER_ADMIN')]
    #[Route('/concerts/update/{id}/admin', name: 'concert_update')]
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