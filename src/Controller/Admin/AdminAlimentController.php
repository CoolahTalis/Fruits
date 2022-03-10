<?php

namespace App\Controller\Admin;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAlimentController extends AbstractController
{
    /**
     * @Route("/admin/adminAliment", name="admin")
     */
    public function AdminPanel(AlimentRepository $repo): Response
    {
        $aliment = $repo->findAll();
        return $this->render('admin/adminAliment.html.twig', [
            'aliments' => $aliment,
            'isCalorie' => false
        ]);
    }

    /**
     * @Route("/admin/modificationAliment/creation", name="modif_aliment_creation")
     * @Route("/admin/modificationAliment/{id}", name="modif_aliment", methods= "GET|POST")
     */
    public function addModification(Aliment $aliment = null, Request $request, EntityManagerInterface $entityManager): Response
    {

        if(!$aliment) {
            $aliment = new Aliment();
        }
        // le param converter va recup l'id, on peut simplement mettre $aliment pour reucp les donner et fill le form
        $form = $this->createForm(AlimentType::class, $aliment);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
        $modif = $aliment->getId() !== null; // on check si l'ID existe
        $entityManager->persist($aliment);
        $entityManager->flush();
        $this->addFlash("success", ($modif) ? " La modification a été effectué" : "L'ajout a été effectuée");
        return $this->redirectToRoute("admin");
    }
        return $this->render('admin/modificationAliment.html.twig', [
            'aliment' => $aliment,
            'form' => $form->createView(),
            "isModification" => $aliment->getid() !== null
        ]);
    }
    /**
     * @Route("/admin/modificationAliment/{id}", name="supp_aliment", methods="delete")
     */
    public function suppression(Aliment $aliment, Request $request, EntityManagerInterface $entityManager): Response
    {
        if($this->isCsrfTokenValid("SUP". $aliment->getId(), $request->get('_token'))){

            $entityManager->remove($aliment);
            $entityManager->flush();
            $this->addFlash("success", "La suppression a été effectué");
            return $this->redirectToRoute("admin");
        }
    }
}
