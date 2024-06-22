<?php

namespace App\Controller;

use App\Entity\CollectionGame;
use App\Form\CollectionGameType;
use App\Repository\CollectionGameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/profile/collection/game')]
class CollectionGameController extends AbstractController
{
    #[Route('/', name: 'app_collection_game_index', methods: ['GET'])]
    public function index(CollectionGameRepository $collectionGameRepository): Response
    {
        return $this->render('collection_game/index.html.twig', [
            'collection_games' => $collectionGameRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_collection_game_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $collectionGame = new CollectionGame();
        $form = $this->createForm(CollectionGameType::class, $collectionGame);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($collectionGame);
            $entityManager->flush();

            return $this->redirectToRoute('app_collection_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('collection_game/new.html.twig', [
            'collection_game' => $collectionGame,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_collection_game_show', methods: ['GET'])]
    public function show(CollectionGame $collectionGame): Response
    {
        return $this->render('collection_game/show.html.twig', [
            'collection_game' => $collectionGame,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_collection_game_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CollectionGame $collectionGame, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CollectionGameType::class, $collectionGame);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_collection_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('collection_game/edit.html.twig', [
            'collection_game' => $collectionGame,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_collection_game_delete', methods: ['POST'])]
    public function delete(Request $request, CollectionGame $collectionGame, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $collectionGame->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($collectionGame);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_collection_game_index', [], Response::HTTP_SEE_OTHER);
    }
}
