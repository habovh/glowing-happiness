<?php

namespace Resto\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Resto\MainBundle\Entity\Theme;
use Resto\MainBundle\Entity\Restaurant;
use Resto\MainBundle\Entity\Plat;

class RestoController extends Controller {

    public function indexAction() {
         $panier = $this->getPanier();
        if(isset($panier))
        {
            

        $total = $this->totalPanier();
        }
        else
        {
            $total = 0;
        }
       
        return $this->render('RestoMainBundle:Resto:index.html.twig', array('total' => $total));
    }


    public function themeAction($themeid)
    {
          $panier = $this->getPanier();
        if(isset($panier))
        {
           

        $total = $this->totalPanier();
        }
        else
        {
            $total = 0;
        }

        if(($themeid == -1) || ($themeid == ''))
        {
            $repository = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:Theme');
            $themes = $repository->findAll();

            return $this->render('RestoMainBundle:Resto:themes.html.twig', array('themes' => $themes, 'total' => $total));
        }
        else
        {
             $repository = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:Theme');
             
             $theme = $repository->find($themeid);

             $restos = $theme->getRestaurants();

             return $this->render('RestoMainBundle:Resto:theme.html.twig', array('restos' => $restos, 'total' => $total));

        }

    }

    public function restoAction($restoid) {
         $panier = $this->getPanier();
        if(isset($panier))
        {
            

        $total = $this->totalPanier();
        }
        else
        {
            $total = 0;
        }

        $repository = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:Restaurant');
        $resto = $repository->find($restoid);
        $plats = $resto->getPlats();

    	return $this->render('RestoMainBundle:Resto:resto.html.twig', array('resto' => $resto, 'plats' => $plats, 'total' => $total));
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
          $panier = $this->getPanier();
        if(isset($panier))
        {
           

        $total = $this->totalPanier();
        }
        else
        {
            $total = 0;
        }

        if($id == -1)
        {
            $repository = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:Restaurant');
            $plats = $repository->getPlats();

            return $this->render('RestoMainBundle:Resto:plats.html.twig', array('plats' => $plats, 'total' => $total));
        }

    }



    public function ajouteArticleAction($id, $quantite)  // Ajoute un article ( plat ) au panier
    {
        $panier = $this->getPanier();
        

        $repo = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:Plat');
        $plat = $repo->find($id);


        $resto = $plat->getRestaurant();
        $plats = $resto->getPlats();

        if(isset($panier[$id]['quantite']))
        {
            $quantiteO = $panier[$id]['quantite'];
        }
        else
        {
            $quantiteO = 0;
        }
        
        if (!is_null($plat)) {
            $panier[$id]['id'] = $plat->getId();
            $panier[$id]['quantite'] = $quantiteO + $quantite;
            $panier[$id]['prix'] = ($plat->getPrix() * $panier[$id]['quantite']);
            $panier[$id]['nom'] = $plat->getNom();

        }

        $session = $this->getRequest()->getSession();
        $session->set('panier', $panier);
        $total = $this->totalPanier();
        

        return $this->render('RestoMainBundle:Resto:resto.html.twig', array('resto' => $resto, 'plats' => $plats, 'total' => $total));
    }

    public function supprimeArticleAction($id)  
    {
        
        $panier = $this->getPanier();


        if (array_key_exists($id, $panier)) {  
            unset($panier[$id]);
        }


        
        $session = $this->getRequest()->getSession();
        $session->set('panier', $panier);
        $total = $this->totalPanier();

        return $this->render('RestoMainBundle:Resto:cart.html.twig', array('panier' => $panier , 'total' => $total));

    }

    public function totalAction()
    {

          $panier = $this->getPanier();
        if(isset($panier))
        {
           

        $total = $this->totalPanier();
        }
        else
        {
            $total = 0;
        }

        return $this->render('RestoMainBundle:Resto:totalPanier.html.twig', array('total' => $total));
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
