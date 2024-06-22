<?php

namespace App\Controller;

use App\Entity\CollectionGame;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $collections = $entityManager->getRepository(CollectionGame::class)->findAll();
        $collections = [];


        return $this->render('home/index.html.twig', [
            'collections' => $collections,
        ]);
    }
}
