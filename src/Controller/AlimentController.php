<?php

namespace App\Controller;

use App\Repository\AlimentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlimentController extends AbstractController
{
    /**
     * @Route("/", name="Aliment")
     */
    public function index(): Response
    {
        return $this->render('aliment/accueil.html.twig', [
            'controller_name' => 'AlimentController',
        ]);
    }

    /**
     * @Route("/aliments", name="Aliments")
     */
    public function aliments(AlimentRepository $repo): Response
    {
        $aliment = $repo->findAll();
        return $this->render('aliment/aliments.html.twig', [
            'aliments' => $aliment,
            'isCalorie' => false
        ]);
    }

    /**
     * @Route("/aliments/{calorie}", name="filtreCalorie")
     *
     * @return response
     */
    public function filtrerParCalories(AlimentRepository $repo, $calorie): response
    {
        $aliments = $repo->getAlimentsParCalories($calorie);
        return $this->render('aliment/aliments.html.twig', [
            'aliments' => $aliments,
            'isCalorie' => true
        ]);
    }

    /**
     * @Route("/aliments", name="Aliments")
     */
    public function AdminPanel(AlimentRepository $repo): Response
    {
        $aliment = $repo->findAll();
        return $this->render('aliment/aliments.html.twig', [
            'aliments' => $aliment,
            'isCalorie' => false
        ]);
    }

}
