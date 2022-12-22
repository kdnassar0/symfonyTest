<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeTybeType;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Expr\Empty_;
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
     * @Route("/employe/add", name="add_employe")
     * @Route("/employe/edit/{id}",name="edit_employe")
     */  

    public function add(ManagerRegistry $doctrine,Employe $employe =null,Request $request)
    {

        //si l'employer ne existe pas .. je vais le creer 
        //si non le get data va recuperer le formulaire pour pouvoir modifier
        if(!$employe){
            $employe = new Employe() ;
         }
  

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

     /**
     * @Route("/employe/delete/{id}", name="delete_employe")
     */

     public function delete(ManagerRegistry $doctrine,Employe $employe)
     {
        $entityManager=$doctrine->getManager();
        $entityManager->remove($employe);
        $entityManager->flush(); 

        return $this->redirectToRoute('app_employe');
      


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




}
