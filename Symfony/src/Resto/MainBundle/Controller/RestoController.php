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
        $plats = $resto->getPlats();

    	return $this->render('RestoMainBundle:Resto:resto.html.twig', array('resto' => $resto, 'plats' => $plats));
    }

    public function panierAction() {

        $panier = $this->getPanier();

        $total = $this->totalPanier();
        

        return $this->render('RestoMainBundle:Resto:cart.html.twig', array('panier' => $panier , 'total' => $total));

    	
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



    public function ajouteArticleAction($id, $quantite)  // Ajoute un article ( plat ) au panier
    {
        $panier = $this->getPanier();
        

        $repo = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:Plat');
        $plat = $repo->find($id);


        $resto = $plat->getRestaurant();
        $plats = $resto->getPlats();

        
        if (!is_null($plat)) {
            $panier[$id]['id'] = $plat->getId();
            $panier[$id]['quantite'] = $quantite;
            $panier[$id]['prix'] = $plat->getPrix();
            $panier[$id]['nom'] = $plat->getNom();

        }

        $session = $this->getRequest()->getSession();
        $session->set('panier', $panier);

        

        return $this->render('RestoMainBundle:Resto:resto.html.twig', array('resto' => $resto, 'plats' => $plats));
    }

    public function supprimeArticleAction($id)  
    {
        
        $panier = $this->getPanier();


        if (array_key_exists($id, $panier)) {  
            unset($panier[$id]);
        }


        $total = $this->totalPanier();
        $session = $this->getRequest()->getSession();
        $session->set('panier', $panier);

        return $this->render('RestoMainBundle:Resto:cart.html.twig', array('panier' => $panier , 'total' => $total));

    }


    private function totalPanier()
    {
       

        $panier = $this->getPanier();

        
        $total = 0;

        
        foreach ($panier as $id => $attributs) {
            if(isset($attributs['prix']))
            {
                $total += $attributs['prix'];
            }
        }

        return $total;


    }

    private function getCurrentUser()
    {
        return $this->container->get('security.context')->getToken()->getUser();
    }


    private function getPanier()
    {
        $session = $this->getRequest()->getSession();
        if(!$session->has('panier'))
        {
           $session->set('panier',  array(
                // indice 'quantite' : quantite / indice 'prix' : prix
                )
           );
        }

        $panier = $session->get('panier');

        return $panier;
    }

}
