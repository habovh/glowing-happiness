<?php

namespace PussyPatrol\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PussyPatrol\MainBundle\Entity\User;


class UsersController extends Controller
{

	

	public function listAction()
    {   


    	$repository = $this->getDoctrine()
    						->getManager()
    						->getRepository('PussyPatrolMainBundle:User');
    	$listeUsers = $repository->findAll();


        return $this->render('PussyPatrolMainBundle:Users:Users.html.twig', array('list' => $listeUsers) );
    }

    public function profileAction($id)
    {   


    	$repository = $this->getDoctrine()
    						->getManager()
    						->getRepository('PussyPatrolMainBundle:User');
    	$user = $repository->find($id);


        return $this->render('PussyPatrolMainBundle:Users:Profile.html.twig', array('user' => $user) );
    }


   



}
