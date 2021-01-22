<?php

namespace App\Controller;

use App\Entity\Header;
use App\Entity\Maquette;
use App\Form\HeaderType;
use App\Repository\HeaderRepository;
use App\Repository\MaquetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends AbstractController
{
    #[Route('/ajax/view/header/{query}', name: 'ajax_view_header')]
    public function index($query, HeaderRepository $repository): Response
    {
        //$repository is directly a HeaderRepository
        $header = $repository->find($query);
        $form = $this->createForm(HeaderType::class, $header);




        //Return json for API
        return $this->json([
            'header' => $header,
            'html' => $this->renderView('ajax/header.html.twig', ['headerForm' => $form->createView(), 'header' => $header]),
            ]);
    }

    #[Route('/ajax/view/upload/header', name: 'ajax_view_upload_header')]
    public function upload(HeaderRepository $repository, Request $request){

        //Find header in bdd
        $header = $repository->find($request->get('header')['id']);
        $form = $this->createForm(HeaderType::class, $header);

        //Upload the header
        $form->handleRequest($request);
        $this->getDoctrine()->getManager()->flush();

        $properties = $repository->findAll();

         //Return json for API
        return $this->json([
            'header' => $header,
            'htmlTest' => $this->renderView('home/view/header.html.twig', ['properties' => $properties]),
            'html' => $this->renderView('ajax/header.html.twig', ['headerForm' => $form->createView(), 'header' => $header]),
            ]);
    }

    /**
     *  - Lier le header a une entity Maquette
     *              un header appartien a une ou plusieurs maquette 
     *              une maquette possède un seul ou zero header
     * on return un json html => $this->renderView('component/header/header.html.twig') avec la variable qu'il faut
     */

     #[Route('/ajax/add/view/header/{query}', name: 'ajax_add_view_header')]
     public function addViewHeader($query, HeaderRepository $repository, MaquetteRepository $repositoryMaquette){
         $header = $repository->find($query);
         $maquette = new Maquette();

         $maquette->setHeader($header);

         /* $entityManager = $this->getDoctrine()->getManager();
         $entityManager->persist($maquette);
         $entityManager->flush(); */

         return $this->json([
             'html' => $this->renderView('component/header.html.twig', ['header' => $header]),
         ]);
     }

    
}