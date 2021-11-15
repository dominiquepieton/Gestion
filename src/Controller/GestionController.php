<?php

namespace App\Controller;

use App\Entity\Gestion;
use App\Form\GestionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('gestion/index.html.twig');
    }


    /**
     * Creation d'une candidature
     * 
     * @Route("/gestion/create", name="gestion_create")
     * @param Request $request
     * @return void
     */
    public function createCandidature(Request $request)
    {
        $gestion = new Gestion();
        $form = $this->createForm(GestionType::class, $gestion);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($gestion);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('gestion/create.html.twig', ['form' => $form->createview()]);
    }
}
