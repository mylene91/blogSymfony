<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
// Add Entity
use App\Entity\Article;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            //instancier article
            $article = new Article();
            $article->setTitle("Titre de l'article n°$i")
                    ->setContent("<p>Contenu de l'article n°$i</p>")
                    ->setImage("http://placehold.it/350x150")
                    // mettre \ pour appeler la classe de php
                    ->setCreatedAt(new \DateTime());


            // demander à mon manager de faire perisiter
            $manager->persist($article);


        }

        // envoie la requete
        $manager->flush();
    }
}
