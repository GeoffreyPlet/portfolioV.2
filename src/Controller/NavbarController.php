<?php

namespace App\Controller;

use App\Entity\Navbar;
use App\Entity\Route as EntityRoute;
use App\Form\NavbarType;
use App\Repository\NavbarRepository;
use App\Repository\RouteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavbarController extends AbstractController
{
    #[Route('/ajax/view/navbar/select/{query}', name: 'navbar')]
    public function index($query, NavbarRepository $repositoryNavbar): Response
    {
       
        $navbar = $repositoryNavbar->findBy(['id' => $query]);
        $formUpload = $this->createForm(NavbarType::class, $navbar[0]);

        return $this->json([
            'html' => $this->renderView('ajax/navbar.html.twig', ['formNavbar' => $formUpload->createView(), 'id' => $query]),
        ]);
     
       
    }

    #[Route('/ajax/view/navbar/add/route', name: 'navbar_add_route')]
    public function addNavbarRoute(Request $request, NavbarRepository $navbarRepository, RouteRepository $routeRepository)
    {
        
        
        $navbar = $navbarRepository->find($request->get('navbar-relation'));

        $route = new EntityRoute();
        $route->setName($request->get('route-name'));
        $route->setNavbar($navbar);

        $formUpload = $this->createForm(NavbarType::class, $navbar);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($route);
        $entityManager->flush();
        

        $allRoute = $routeRepository->findAll();
        $allNavbar = $navbarRepository->findAll();

        return $this->json([
            'htmlNavbarView' => $this->renderView('ajax/navbar-view.html.twig', ['navbars' => $allNavbar, 'routes' => $allRoute]),
            'html' => $this->renderView('ajax/navbar.html.twig', ['formNavbar' => $formUpload->createView(), 'id' => $request->get('navbar-relation')]),
        ]);
        


    }
}
