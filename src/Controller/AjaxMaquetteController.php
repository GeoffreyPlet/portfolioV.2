<?php

namespace App\Controller;

use App\Entity\Maquette;
use App\Repository\MaquetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxMaquetteController extends AbstractController
{
    //Route for add a maquette
    #[Route('/ajax/add/maquette', name: 'ajax_add_maquette')]
    public function index(MaquetteRepository $repository)
    {
        //Create a new maquette
        $maquette = new Maquette();
        $maquette->setSelecting(false);

        //Add the maquette in data base
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($maquette);
        $entityManager->flush();

        //Find all maquettes in data base
        $allMaquette = $repository->findAll();

        /**
         * return a json response
         * response = {'html' => 'html generate with ajax/create-maquette.html.twig'}
         */
        return $this->json([
            'html' => $this->renderView('ajax/create-maquette.html.twig', ['maquettes' => $allMaquette,
                                                                            'display' => 'block']),
        ]);
        
    }

    //Route for select a maquette, and start buidling for view
    #[Route('/ajax/select/maquette', name: 'ajax_select_maquette')]
    public function select(MaquetteRepository $repository, Request $request)
    {

        //Find all maquette
        $allMaquette = $repository->findAll();

        $checkHeader = null;


        foreach($allMaquette as $oneMaquette){
            if($oneMaquette->getId() == $request->get('id')){
                $oneMaquette->setSelecting(true);
                $checkHeader = $oneMaquette->getHeader();
                $this->getDoctrine()->getManager()->flush();
            }
            else{
                $oneMaquette->setSelecting(false);
                $this->getDoctrine()->getManager()->flush();
            }
        }
        

        
        return $this->json([
            'html' => $this->renderView('ajax/create-maquette.html.twig', ['maquettes' => $allMaquette,
                                                                            'display' => 'block']),
            'htmlView' => $this->renderView('component/header.html.twig', ['header' => $checkHeader]),
        ]);

    }

    #[Route('/ajax/delete/maquette', name: 'ajax_delete_maquette')]
    public function delete(Request $request, MaquetteRepository $repository)
    {
       
        $maquette = $repository->find($request->get('id'));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($maquette);
        $entityManager->flush();

        $allMaquette = $repository->findAll();
        return $this->json([
            'html' => $this->renderView('ajax/create-maquette.html.twig', ['maquettes' => $allMaquette,
                                                                            'display' => 'block']),
        ]);
    }
}
