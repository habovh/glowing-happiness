<?php

namespace Resto\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RestoController extends Controller {

    public function indexAction() {
        return $this->render('RestoMainBundle:Resto:index.html.twig');
    }

    public function themeAction($themeid) 
    {
        $repository = $this->getDoctrine()->getManager->getRepository('RestoMainBundle:theme');
        $restos = $repository->getRestos();

    	return $this->render('RestoMainBundle:Resto:theme.html.twig', array('restos' => $restos));
    }

    public function restoAction($restoid) {
    	return $this->render('RestoMainBundle:Resto:resto.html.twig', array('restoid' => $restoid));
    }

    public function cartAction() {
    	return $this->render('RestoMainBundle:Resto:cart.html.twig');
    }
}
