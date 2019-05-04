<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

// importer la classe Articles
use App\Entity\Article;


class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);

        // findOneByTitle('Titre de l\'article); <- trouvera par nom d'article si identique etc.
        $articles = $repo->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    // je veux dans la page /blog recup liste de mes articles et les donner à twig pour qu'il les affiche
    // repository des articles

    /**
     * @Route("/", name="home")
     */
    public function  home() {
        return $this->render('blog/home.html.twig', [
            'title' => 'Bienvenue sur mon blog !',
            'age' => 33

        ]);
    }

    /**
     * @Route("/blog/12", name="blog_show")
     */
    public function show() {
        return $this->render('blog/show.html.twig');
    }
}
