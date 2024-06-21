<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CollectionController extends AbstractController
{
    #[Route('/collection/{id}', name: 'app_collection')]
    public function index(): Response
    {
        $games = [];

        return $this->render('collection/index.html.twig', [
            'games' => $games,
        ]);
    }
}
