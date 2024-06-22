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

class CollectionController extends AbstractController
{
    #[Route('/collection', name: 'app_collection')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $collections = $entityManager->getRepository(CollectionGame::class)->findAll();

        return $this->render('collection/index.html.twig', [
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

        return $this->render('collection/new.html.twig', [
            'collectionForm' => $form->createView(),
        ]);
    }
}
