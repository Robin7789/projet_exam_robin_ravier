<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        $user = $this->getUser();

        // if (!$user) {
        //     throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette page.');
        // }

        return $this->render('profile/index.html.twig', [
            'user' => $user,
        ]);
    }
}
