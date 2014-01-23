<?php

namespace Resto\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RestoController extends Controller {

    public function indexAction() {
        return $this->render('RestoMainBundle:Resto:index.html.twig');
    }

    public function themeAction($themeid) {
    	return $this->render('RestoMainBundle:Resto:theme.html.twig', array('themeid' => $themeid));
    }

    public function restoAction($restoid) {
    	return $this->render('RestoMainBundle:Resto:resto.html.twig', array('restoid' => $restoid));
    }

    public function cartAction() {
    	return $this->render('RestoMainBundle:Resto:cart.html.twig');
    }

    public function registerAction() {
    	return $this->render('RestoMainBundle:Resto:register.html.twig');
    }

    public function userAction($userid) {
    	if ($userid == -1) {
    		return $this->render('RestoMainBundle:Resto:personal_profile.html.twig');
    	}
    	else {
    		return $this->render('RestoMainBundle:Resto:any_profile.html.twig');
    	}
    }
}
