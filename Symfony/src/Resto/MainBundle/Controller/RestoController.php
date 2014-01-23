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
}
