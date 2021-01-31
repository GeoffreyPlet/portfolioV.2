<?php

namespace App\Controller;

use App\Entity\Navbar;
use App\Entity\Route as EntityRoute;
use App\Form\NavbarType;
use App\Repository\HeaderRepository;
use App\Repository\MaquetteRepository;
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

    #[Route('/ajax/view/navbar/delete/navbar', name: 'navbar_delete')]
    public function deleteNavbar(Request $request, RouteRepository $routeRepository, NavbarRepository $navbarRepository){


        $routes = $routeRepository->findRouteWithNavbarId($request->get('id'));

        foreach($routes as $route){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($route);
            $entityManager->flush();
        }
        
        $navbar = $navbarRepository->find($request->get('id'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($navbar);
        $entityManager->flush();

        $allRoute = $routeRepository->findAll();
        $allNavbar = $navbarRepository->findAll();

        return $this->json([
            'html' => $this->renderView('ajax/navbar-view.html.twig', ['navbars' => $allNavbar, 'routes' => $allRoute]),
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

    #[Route('/ajax/view/navbar/update/navbar', name: 'update_navbar')]
    public function updateNavbar(Request $request, NavbarRepository $navbarRepository, RouteRepository $routeRepository)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        
        $navbar = $navbarRepository->find($id);
        $navbar->setName($name);
        $this->getDoctrine()->getManager()->flush();

        $formUpload = $this->createForm(NavbarType::class, $navbar);

        $allRoute = $routeRepository->findAll();
        $allNavbar = $navbarRepository->findAll();

        return $this->json([
            'htmlNavbarView' => $this->renderView('ajax/navbar-view.html.twig', ['navbars' => $allNavbar, 'routes' => $allRoute]),
            'html' => $this->renderView('ajax/navbar.html.twig', ['formNavbar' => $formUpload->createView(), 'id' => $id]),
        ]);

    }

    #[Route('/ajax/view/navbar/add/header/{query}', name: 'navbar_add_header')]
    public function addNavbarInHeader($query, NavbarRepository $navbarRepository, MaquetteRepository $maquetteRepository, RouteRepository $routeRepository){

        $navbar = $navbarRepository->find($query);
        $allMaquette = $maquetteRepository->findAll();

        foreach($allMaquette as $maquette){
            if($maquette->getSelecting() === true){
                $maquette->setNavbar($navbar);
                $this->getDoctrine()->getManager()->flush();
            }
        }

        $routes = $routeRepository->findAll();

        return $this->json([
            'html' => $this->renderView('component/navbar.html.twig', ['navbar' => $navbar, 'routes' => $routes]),
        ]);
    }
}
