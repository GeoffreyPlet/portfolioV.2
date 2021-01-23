<?php

namespace App\Controller;

use App\Repository\MaquetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxUploadSiteController extends AbstractController
{
    #[Route('/ajax/upload/site', name: 'ajax_upload_site')]
    public function index(Request $request, MaquetteRepository $maquetteRepository)
    {   
        //Variable need for script
        $filesystem = new Filesystem();
        $maquette = $maquetteRepository->findOneBy(['selecting' => true]);


        $filesystem->mkdir('../creation/site-'.$maquette->getId());
        $filesystem->mkdir('../creation/site-'.$maquette->getId().'/img/uploads');

        $filesystem->copy($this->getParameter('upload_directory').'/'.$maquette->getHeader()->getImage(), '../creation/site-'.$maquette->getId().'/img/uploads/'.$maquette->getHeader()->getImage());
        
        $filesystem->dumpFile('../creation/site-'.$maquette->getId().'/index.html', $request->get('header'));
        
    }
}
