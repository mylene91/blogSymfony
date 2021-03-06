<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

// importer la classe Articles
use App\Entity\Article;


class BlogController extends AbstractController
{

    // je veux dans la page /blog recup liste de mes articles et les donner à twig pour qu'il les affiche
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo)
    {
        // je demande a doctrine de me donner un repository : Màj : plus besoin grâce à l'injection de dépendances
        // findOneByTitle('Titre de l\'article); <- trouvera par nom d'article si identique etc.
        $articles = $repo->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }



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
     * @Route ("/blog/new", name="blog_create")
     */
    // on remonte la méthode dans le code pour éviter que ça orte à confusion au niveau des routes avec {id} de la route de la méthode show
    public function create() {
        return $this->render('blog/create.html.twig');
    }

    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    // converti un parametre de la requete en objet
    public function show(Article $article) { // grace au @ParamConverter de symfony plus besoin de demander (ArticleRepository $repo, $id) et $article = $repo->find($id);
        //$repo = $this->getDoctrine()->getRepository((Article::class));
        // trouve l'article qui a le même id qu'on m'a passé
        //$article = $repo->find($id);

        return $this->render('blog/show.html.twig', [
            'article' => $article
        ]);
    }


}
