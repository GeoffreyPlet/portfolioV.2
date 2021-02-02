<?php

namespace App\Controller;

use App\Entity\Footer;
use App\Entity\Header;
use App\Entity\Maquette;
use App\Entity\Navbar;
use App\Form\FooterType;
use App\Form\HeaderType;
use App\Form\NavbarType;
use App\Repository\NavbarRepository;
use App\Repository\RouteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
    public function create(Request $request, ValidatorInterface $validator, NavbarRepository $navbarRepository, RouteRepository $routeRepository): Response
    {
        $allRoute = $routeRepository->findAll();
        $allNavbar = $navbarRepository->findAll();

        /* #Start [FORM FOOTER] */
            $footer = new Footer();
            $formFooter = $this->createForm(FooterType::class, $footer);
            $formFooter->handleRequest($request);

            if($formFooter->isSubmitted() && $formFooter->isValid() && empty($errorsNavbar))
            {
                $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($footer);
                    $entityManager->flush();
    
                    return $this->redirectToRoute('home_create');
            }
        /* #END [FORM FOOTER] */

        /* #START [FORM NAVBAR] */
            $navbar = new Navbar();
            $formNavbare = $this->createForm(NavbarType::class, $navbar);
            $formNavbare->handleRequest($request);
            $errorsNavbar = [];


            
            /* #START [GET ERRORS NAVBAR] */
                if(empty($request->get('navbar')['name']) && $request->get('nav-option') === 'name'){
                    $errorsNavbar[] = 'Le nom du site ne peut pas être vide';
                    $displayNavbar = 'block';
                
                }elseif(!empty($request->get('navbar')['name']) && $request->get('nav-option') === 'name'){
                    $navbar->setName($request->get('navbar')['name']);
                }
                else{

                    /* #START UPLOAD IMAGE */
                        /** @var UploadedFile $image */
                        $image = $formNavbare->get('logo')->getData();
                        if($image)
                        {
                            $fileName = uniqid().'.'.$image->guessExtension();
                            $image->move($this->getParameter('upload_directory'), $fileName);
                            $navbar->setName($fileName);
                        } else
                        {
                            $navbar->setName('default.jpg');
                        }
                    /* #END UPLOAD IMAGE */

                    $displayNavbar = 'none';
                }
            /* #END [GET ERRORS NAVBAR] */

            if($formNavbare->isSubmitted() && $formNavbare->isValid() && empty($errorsNavbar))
            {
                $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($navbar);
                    $entityManager->flush();
    
                    return $this->redirectToRoute('home_create');
            }
        /* #END [FORM NAVBAR] */

        /**
         * #START PHP SCRIPT FOR ADD VIEW HEADER
         */
            $repository = $this->getDoctrine()->getRepository(Header::class);
            $properties = $repository->findAll();

            $repository = $this->getDoctrine()->getRepository(Maquette::class);
            $allMaquette = $repository->findAll();
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
            

            /* #START [CHECK ERRORS] */
                $errorsHeader = $validator->validate($form);
                /* If i got errors in my header form i set $displayHeader as block
                * @displayHeader for kwon if show the modal create-header.html.twig 
                */
                if(!empty($errorsHeader[0])){
                    $displayHeader = 'block';
                }else{

                    $displayHeader = 'none';
                }
            /* #STENDART [CHECK ERRORS] */
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
            'maquettes' => $allMaquette,
            'navbars' => $allNavbar,
            'routes' => $allRoute,
            'navbarForm' => $formNavbare->createView(),
            'footerForm' => $formFooter->createView(),
            'display' => null,
            'errorsHeader' => $errorsHeader,
            'displayHeader' => $displayHeader,
            'errorsNavbar' => $errorsNavbar,
            'displayNavbar' => $displayNavbar,
        ]);
    }

   
}
