<?php

namespace App\Controller;

use App\Entity\CollectionGame;
use App\Form\CollectionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/profile')]
class CollectionController extends AbstractController
{
    #[Route('/collection', name: 'app_collection')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $collections = $entityManager->getRepository(CollectionGame::class)->findAll();

        return $this->render('collectionGame/index.html.twig', [
            'collections' => $collections,
        ]);
    }

    #[Route('/collection/new', name: 'app_collection_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        $collection = new CollectionGame();
        $user = $security->getUser();
        $collection->setUser($user);
        $collection->setAddedDate(new \DateTime());

        $form = $this->createForm(CollectionType::class, $collection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($collection);
            $entityManager->flush();

            return $this->redirectToRoute('app_collection');
        }

        return $this->render('collectionGame/new.html.twig', [
            'collectionForm' => $form->createView(),
        ]);
    }

    #[Route('/collection/{id}', name: 'app_collection_show', methods: ['GET'])]
    public function show(CollectionGame $collection): Response
    {
        return $this->render('collectionGame/show.html.twig', [
            'collection' => $collection,
        ]);
    }

    #[Route('/collection/{id}/edit', name: 'app_collection_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CollectionGame $collection, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CollectionType::class, $collection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_collection');
        }

        return $this->render('collectionGame/edit.html.twig', [
            'collectionForm' => $form->createView(),
            'collection' => $collection,
        ]);
    }

    #[Route('/collection/{id}', name: 'app_collection_delete', methods: ['POST'])]
    public function delete(Request $request, CollectionGame $collection, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $collection->getId(), $request->request->get('_token'))) {
            $entityManager->remove($collection);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_collection');
    }
}
