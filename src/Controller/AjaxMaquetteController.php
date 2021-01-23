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
    #[Route('/ajax/add/maquette', name: 'ajax_add_maquette')]
    public function index(MaquetteRepository $repository)
    {
        $maquette = new Maquette();
        $maquette->setSelecting(false);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($maquette);
        $entityManager->flush();

        $allMaquette = $repository->findAll();

        return $this->json([
            'html' => $this->renderView('ajax/create-maquette.html.twig', ['maquettes' => $allMaquette,
                                                                            'display' => 'block']),
        ]);
        
    }

    #[Route('/ajax/select/maquette', name: 'ajax_select_maquette')]
    public function select(MaquetteRepository $repository, Request $request)
    {

        $allMaquette = $repository->findAll();
        foreach($allMaquette as $oneMaquette){
            if($oneMaquette->getId() == $request->get('id')){
                $oneMaquette->setSelecting(true);
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
        ]);

    }
}
