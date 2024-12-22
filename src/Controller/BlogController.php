<?php
namespace App\Controller;


use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/', name: 'app_blog')]
    public function index(ArticleRepository $articleRepository): Response
    {
        // Récupère tous les articles
        $articles = $articleRepository->findAll();

        // Passe les articles au template
        return $this->render('blog/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
