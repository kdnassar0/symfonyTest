<?php

namespace App\Controller;

use App\Entity\Employe;
use Doctrine\Persistence\ManagerRegistry;
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
}
