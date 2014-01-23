<?php

namespace Resto\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RestoController extends Controller {

    public function indexAction() {
        return $this->render('RestoMainBundle:Resto:index.html.twig');
    }

    public function themeAction($themeid) 
    {
        if($themeid == -1)
        {
             $repository = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:theme');
            $themes = $repository->findAll();

            return $this->render('RestoMainBundle:Resto:theme.html.twig', array('themes' => $themes));
        }
        else
        {
             $repository = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:theme');
             $restos = $repository->getRestos();

        return $this->render('RestoMainBundle:Resto:theme.html.twig', array('restos' => $restos));
        }
       
    }

    public function restoAction($restoid)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:resto');
        $resto = $repository->find($restoid);

    	return $this->render('RestoMainBundle:Resto:resto.html.twig', array('resto' => $resto));
    }

    public function cartAction() {


    	return $this->render('RestoMainBundle:Resto:cart.html.twig');
    }

    public function userAction($userid) {
    	return $this->render('RestoMainBundle:Resto:user.html.twig');
    }

    public function profileAction() {
    	return $this->render('RestoMainBundle:Resto:profile.html.twig');
    }
}
