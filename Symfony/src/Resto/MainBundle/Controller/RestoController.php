<?php

namespace Resto\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Resto\MainBundle\Entity\Theme;
use Resto\MainBundle\Entity\Restaurant;
use Resto\MainBundle\Entity\Plat;

class RestoController extends Controller {

    public function indexAction() {
        return $this->render('RestoMainBundle:Resto:index.html.twig');
    }


    public function themeAction($themeid) 
    {
        if(($themeid == -1) || ($themeid == ''))
        {
            $repository = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:Theme');
            $themes = $repository->findAll();

            return $this->render('RestoMainBundle:Resto:themes.html.twig', array('themes' => $themes));
        }
        else
        {
             $repository = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:Theme');
             
             $theme = $repository->find($themeid);

             $restos = $theme->getRestaurants();

             return $this->render('RestoMainBundle:Resto:theme.html.twig', array('restos' => $restos));

        }

    }

    public function restoAction($restoid) {

        $repository = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:Restaurant');
        $resto = $repository->find($restoid);

    	return $this->render('RestoMainBundle:Resto:resto.html.twig', array('resto' => $resto));
    }

    public function cartAction() {

        $user = $this->getCurrentUser();

        if (is_object($user) || $user instanceof UserInterface) {
            var_dump($user);
        }


        var_dump($user->getUsername());

      

    	return $this->render('RestoMainBundle:Resto:cart.html.twig');
    }

    public function userAction($userid) {

        $repository = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:User');
        $user = $repository -> find($userid);

    	return $this->render('RestoMainBundle:Resto:user.html.twig', array('user' => $user));
    }


    public function platAction($id)
    {
        if($id == -1)
        {
            $repository = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:Restaurant');
            $plats = $repository->getPlats();

            return $this->render('RestoMainBundle:Resto:plats.html.twig', array('plats' => $plats));
        }

    }


    private function getCurrentUser()
    {
        return $this->container->get('security.context')->getToken()->getUser();
    }
}
