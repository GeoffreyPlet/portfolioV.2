<?php

namespace App\Controller;

use App\Entity\Header;
use App\Form\HeaderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    //Route for create a Header entity
    #[Route('/create', name: 'home_create')]
    public function create(Request $request): Response
    {

        /**
         * #START PHP SCRIPT FOR ADD VIEW HEADER
         */
            $repository = $this->getDoctrine()->getRepository(Header::class);
            $properties = $repository->findAll();
        /**
         * #END PHP SCRIPT FOR ADD VIEW HEADER
         */

        /**
         * #START PHP SCRIPT FOR ADD A HEADER
         */
            // Init my class & my form for add header
            $header = new Header();
            $form = $this->createForm(HeaderType::class, $header);

            $form->handleRequest($request); //Link the formulaire with request
            
            
            if( $form->isSubmitted() && $form->isValid())
            {
               
                    /* #START UPLOAD IMAGE */
                    /** @var UploadedFile $image */
                    $image = $form->get('image')->getData();
                    if($image)
                    {
                        $fileName = uniqid().'.'.$image->guessExtension();
                        $image->move($this->getParameter('upload_directory'), $fileName);
                        $header->setImage($fileName);
                    } else
                    {
                        $header->setImage('default.jpg');
                    }
                    /* #END UPLOAD IMAGE */
    
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($header);
                    $entityManager->flush();
    
                    return $this->redirectToRoute('home_create');
                
            }
        /**
         * #END PHP SCRIPT FOR ADD A HEADER
         */
        
        return $this->render('home/create.html.twig', [
            'headerForm' => $form->createView(),
            'properties' => $properties,
        ]);
    }

   
}
