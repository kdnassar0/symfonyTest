<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeTybeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmployeController extends AbstractController
{
    /**
     * @Route("/employe", name="app_employe")
     */
    public function index(ManagerRegistry $doctrine): Response
    {

        $employers = $doctrine->getRepository(Employe::class)->findAll();
        return $this->render('employe/index.html.twig', [
          'employes' =>$employers
        ]);
    }

    /**
     * @Route("/employe/{id}", name="show_employe")
     */

    public function show(Employe $employe):Response
    {
        return $this->render('employe/show.html.twig', [
            'employe' =>$employe
          ]);
      

    }


      /**
     * @Route("/employe/add", name="add_employe")
     */  

    public function add(ManagerRegistry $doctrine,Employe $employe =null,Request $request)
    {
  

     $form = $this->createForm(EmployeTybeType ::class,$employe ) ; 
     $form->handleRequest($request); 

     if($form->isSubmitted() && $form->isValid()){

    $employe =$form->getData();
    $entityManager =$doctrine->getManager();
    $entityManager->persist($employe); //prepare
    $entityManager->flush(); //insert into 

    return $this->redirectToRoute('app_employe');

     }
     return $this->render('employe/add.html.twig', ['formAddEmploye' =>$form->createView() ] 
        
    );
}
}
