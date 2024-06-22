<?php

namespace App\Controller;

use App\Entity\NewsletterSubscription;
use App\Form\NewsletterSubscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsletterController extends AbstractController
{
    #[Route('/newsletter', name: 'app_newsletter')]
    public function subscribe(Request $request, EntityManagerInterface $entityManager): Response
    {
        $subscription = new NewsletterSubscription();
        $form = $this->createForm(NewsletterSubscriptionType::class, $subscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($subscription);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('newsletter/index.html.twig', [
            'newsletterForm' => $form->createView(),
        ]);
    }
}
