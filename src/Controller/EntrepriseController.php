<?php

namespace App\Controller;

use App\Entity\Entreprise;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EntrepriseController extends AbstractController
{
    /**
     * @Route("/entreprise", name="app_entreprise")
     */
    public function index(ManagerRegistry $doctrine): Response
    { 
        //va recuperer toutes les entreprises de bdd
        $entreprises = $doctrine->getRepository(Entreprise::class)->findAll();

        //getRepository  va chercher la repository de la class que on veut

        return $this->render('entreprise/index.html.twig', [
           'entreprises'=>$entreprises
        ]);
    }

        /**
     * @Route("/entreprise/{id}", name="show_employe")
     */                                                         
                                                            //on ne peux pas difinir une methode qui a la meme route deux fois
    public function show(Entreprise $entreprise):Response   //fonctionne va recuperer l'entreprise qui a comme id=5 par example
    {
        return $this->render('entreprise/show.html.twig', [
            'entreprise' =>$entreprise
          ]);
      

    }

}
