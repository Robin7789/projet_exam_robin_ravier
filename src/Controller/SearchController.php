<?php

namespace App\Controller;

use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/search', name: 'app_search')]
    public function search(Request $request, PaginatorInterface $paginator): Response
    {
        $query = $request->query->get('q');
        $queryBuilder = $this->entityManager->getRepository(Game::class)->createQueryBuilder('g');

        if ($query) {
            $queryBuilder->where('g.title LIKE :query')
                ->setParameter('query', '%' . $query . '%');
        }

        $pagination = $paginator->paginate(
            $queryBuilder->getQuery(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('search/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}
