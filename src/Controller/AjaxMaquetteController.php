<?php

namespace App\Controller;

use App\Entity\Maquette;
use App\Repository\MaquetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxMaquetteController extends AbstractController
{
    #[Route('/ajax/add/maquette', name: 'ajax_add_maquette')]
    public function index(MaquetteRepository $repository)
    {
        $maquette = new Maquette();

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($maquette);
        $entityManager->flush();

        $allMaquette = $repository->findAll();

        return $this->json([
            'html' => $this->renderView('ajax/create-maquette.html.twig', ['maquettes' => $allMaquette,
                                                                            'display' => 'block']),
        ]);
        
    }
}
