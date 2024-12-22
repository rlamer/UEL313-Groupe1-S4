<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Article;
use App\Entity\Admin;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // // Création d'un utilisateur
        $admin = new Admin();
        $admin->setUsername('admin');
        $hashedPassword = $this->passwordHasher->hashPassword($admin, 'admin');
        $admin->setPassword($hashedPassword);
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        // Création d'articles
        $article = new Article();
        $article->setTitre('Premier Article');
        $article->setTexte('Lorem ipsum dolor sit amet');
        $article->setLink("https://example.com/first-article");
        $manager->persist($article);

        $article = new Article();
        $article->setTitre('Second Article');
        $article->setTexte('Lorem ipsum dolor sit amet');
        $article->setLink("https://example.com/first-article");
        $manager->persist($article);

        $manager->flush();
    }
}
