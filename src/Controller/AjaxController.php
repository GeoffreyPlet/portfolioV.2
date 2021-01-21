<?php

namespace App\Controller;

use App\Entity\Header;
use App\Form\HeaderType;
use App\Repository\HeaderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
            'html' => $this->renderView('ajax/header.html.twig', ['headerForm' => $form->createView()]),
            ]);
    }
}