<?php

namespace PussyPatrol\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PussyPatrol\MainBundle\Entity\User;


//$session = new Session();
//$session->start();


class IndexController extends Controller
{

	

	public function indexAction()
    {    	
        return $this->render('PussyPatrolMainBundle:Main:index.html.twig');
    }


   



}
