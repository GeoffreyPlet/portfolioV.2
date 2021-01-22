<?php

namespace App\Controller;

use App\Entity\Header;
use App\Form\HeaderType;
use App\Repository\HeaderRepository;
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

    
}