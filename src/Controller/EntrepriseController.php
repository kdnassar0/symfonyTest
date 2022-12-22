<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Form\EntrepriseTybeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/entreprise/add", name="add_entreprise")
     */  

    public function add(ManagerRegistry $doctrine,Entreprise $entreprise =null,Request $request)
    {
    //managerRegistry : pour pouvoir utiliser doctrine en avoir un lien en bdd     
     //  on a besoin un objet entreprise parce on  av ajouter une entreprise 
     //un objet 

     $form = $this->createForm(EntrepriseTybeType ::class,$entreprise ) ; //va faire un formulaire qui va reposer sur l'entite entreprise 
     $form->handleRequest($request); //quand il y a un action il va pouvoir aller chercher dans la bdd et faire la modification dedan

     if($form->isSubmitted() && $form->isValid()){

        //ici on fait le traitement de notre formulaire
        //isSubmitted pour le botton submit/is valid pour faire les filters 

    $entreprise =$form->getData(); //ca recupere les donnees qui ont été saisi dans le formulaire et ca va edrater l'objet entreprise(ca va lui donner des valeur)
    $entityManager =$doctrine->getManager();
    $entityManager->persist($entreprise); //prepare
    $entityManager->flush(); //insert into 

    return $this->redirectToRoute('app_entreprise');

     }




//vue pour afficher le formulaire d'ajout 
     return $this->render('entreprise/add.html.twig', ['formAddEntreprise' =>$form->createView() ] 
        
     );

     //createNew pour faire le lien entre la vue et le formulaire (generer le formulaire visualment)
     

    }





     /**
     * @Route("/entreprise/{id}", name="show_employe")
     */                                                         
                                                     //on ne peux pas difinir une methode qui a la  meme route deux fois
    public function show(Entreprise $entreprise):Response   //fonctionne va recuperer l'entreprise qui a comme id=5 par example
    {
        return $this->render('entreprise/show.html.twig', [
            'entreprise' =>$entreprise
          ]);
      

    }



}
