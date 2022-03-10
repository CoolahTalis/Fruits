<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AlimentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $a1 = new Aliment();
        $a1->setNom("Pomme")
            ->setCalorie(10)
            ->setPrix(100)
            ->setImage("pomme.png")
            ->setProteine(0.20)
            ->setGlucide(4.32)
            ->setLipide(0.31);

        $manager->persist($a1);

        $a2 = new Aliment();
        $a2->setNom("Poire")
            ->setCalorie(12)
            ->setPrix(100)
            ->setImage("poire.png")
            ->setProteine(0.20)
            ->setGlucide(4.32)
            ->setLipide(0.31);

        $manager->persist($a2);

        $a3 = new Aliment();
        $a3->setNom("Orange")
            ->setCalorie(20)
            ->setPrix(100)
            ->setImage("orange.png")
            ->setProteine(0.20)
            ->setGlucide(4.32)
            ->setLipide(0.31);

        $manager->persist($a3);

        $manager->flush();
    }
}
