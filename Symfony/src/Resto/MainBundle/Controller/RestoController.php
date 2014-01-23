<?php

namespace Resto\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Resto\MainBundle\Entity\Theme;
use Resto\MainBundle\Entity\Restaurant;

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

            return $this->render('RestoMainBundle:Resto:themes.html.twig', array('themes' => $themes));
        }
        else
        {
             $repository = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:theme');
             $restos = $repository->getRestaurants();

        return $this->render('RestoMainBundle:Resto:theme.html.twig', array('restos' => $restos));
        }

    }

    public function restoAction($restoid) {

        $repository = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:restaurant');
        $resto = $repository->find($restoid);

    	return $this->render('RestoMainBundle:Resto:resto.html.twig', array('resto' => $resto));
    }

    public function cartAction() {

        $manager = $this->getDoctrine()->getManager();

        $data = array(

        'Chinois' => 'Les saveurs asiatiques prés de chez vous',
        'Mexicain' => 'Ayaya, Caramba !',
        'Japonais' => 'Les livraisons, cela ne pose pas de sushi.',
        'Pizza' => 'Une catégorie a part (!) entière. ',
        'Indien' => 'Cuisine Indienne et pakistanaise.'
        
        );

        $repo = $manager->getRepository('RestoMainBundle:Theme');


        $r = new Restaurant();
        $r->setNom('Chez Mario et Luigi');
        $r->setDescription('Les pizzaiolos du jeu video !!');
        $r->setAdresse('8 rue sous le tuyau.\r\nMarioLand');
        $r->setMail('mario@marioland');
        $r->setNote(4);
        $r->setTel('+33 x xx xx xx xx');


        $theme = $repo->findOneByNom('Pizza');

        $r->setTheme($theme);
 

        $manager->persist($r);

        $manager->flush();


        $r = new Restaurant();
        $r->setNom('Fu Mange Tout');
        $r->setDescription('Le meilleur restaurant chinois de toute la ville.');
        $r->setAdresse('Shangai');
        $r->setMail('Fu@MangTout');
        $r->setNote(1);
        $r->setTel('+33 x xx xx xx xx');

        $theme = $repo->findOneByNom('Chinois');

        $r->setTheme($theme);
 

        $manager->persist($r);

        $manager->flush();

        $r = new Restaurant();
        $r->setNom('Les sushis sont secs');
        $r->setDescription('Une tradition directement venue du Japon. Tous les sushis de vos souhaits !');
        $r->setAdresse('32 Rue de Totoro\r\nNancy');
        $r->setMail('Sushi@sonsecs');
        $r->setNote(3);
        $r->setTel('+33 x xx xx xx xx');

        $theme = $repo->findOneByNom('Japonais');

        $r->setTheme($theme);
 

        $manager->persist($r);

        $manager->flush();



        $r = new Restaurant(); 


         $r->setNom('SMSexicain');
         $r->setDescription('Le meilleur restaurant de TextMex. Tapas et Fajitas à volonté (et plus encore).\r\n\r\nPour ceux qui n\'ont pas froid aux yeux');
         $r->setAdresse('14 rue de la grand place\r\nLaxouVille\r\n');
         $r->setMail('sms@xicain');
         $r->setNote(2);
         $r->setTel('+33 x xx xx xx xx');

         $theme = $repo->findOneByNom('Mexicain');

        $r->setTheme($theme);
   
        $manager->persist($r);

        $manager->flush();

        $r = new Restaurant();
   
         $r->setNom('Pizza the Hut');
         $r->setDescription('La seule pizzeria qui possède l\'achtusse.');
         $r->setAdresse('2 impasse de la galaxie\r\nLuxembourgVille');
         $r->setMail('pizza@thehut');
         $r->setNote(4);
         $r->setTel('+33 x xx xx xx xx');


         $theme = $repo->findOneByNom('Pizza');

        $r->setTheme($theme);
   
        $manager->persist($r);

        $manager->flush();


        $r = new Restaurant();

         $r->setNom('Yamazaki');
         $r->setDescription('De nombreux sushis fait avec amour et avec le poisson le plus frais du marché.');
         $r->setAdresse('5 Grand Rue\r\nMalzéville');
         $r->setMail('yama@saki');
         $r->setNote(3);
         $r->setTel('+33 x xx xx xx xx');

         $theme = $repo->findOneByNom('Japonais');

        $r->setTheme($theme);

         $manager->persist($r);

        $manager->flush();

        $r = new Restaurant();

         $r->setNom('Little Pakistan');
         $r->setDescription('Délices du Pakistan');
         $r->setAdresse('12 rue du Faubour des Trois Maison, 54000, nancy');
         $r->setMail('little@pakistan');
         $r->setNote(5);
         $r->setTel('+33 x xx xx xx xx');

         $theme = $repo->findOneByNom('Indien');

        $r->setTheme($theme);

         $manager->persist($r);

        $manager->flush();

        $r = new Restaurant();

         $r->setNom('Le Taj Mahal');
         $r->setDescription('On aime les épices');
         $r->setAdresse('45 rue des Fabrique, 54000 Nancy');
         $r->setMail('taj@mahal');
         $r->setNote(5);
         $r->setTel('+33 x xx xx xx xx');

         $theme = $repo->findOneByNom('Indien');

        $r->setTheme($theme);


        $manager->persist($r);

        $manager->flush();


    	return $this->render('RestoMainBundle:Resto:cart.html.twig');
    }

    public function userAction($userid) {

        $repository = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:user');
        $user = $repository -> find($userid);

    	return $this->render('RestoMainBundle:Resto:user.html.twig', array('user' => $user));
    }

    public function profileAction() {
    	return $this->render('RestoMainBundle:Resto:profile.html.twig');
    }

    public function platAction($id)
    {
        if($id == -1)
        {
            $repository = $this->getDoctrine()->getManager()->getRepository('RestoMainBundle:restaurant');
            $plats = $repository->getPlats();

            return $this->render('RestoMainBundle:Resto:plats.html.twig', array('plats' => $plats));
        }

    }
}
