<?php
// src/Sdz/BlogBundle/DataFixtures/ORM/Categories.php
namespace Resto\MainBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Resto\MainBundle\Entity\Categorie;


class Themes implements FixtureInterface
{
	// Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
	public function load(ObjectManager $manager)
	{
		// Liste des noms de catégorie à ajouter
		



		$data = array(

		'Chinois' => 'Les saveurs asiatiques prés de chez vous',
		'Mexicain' => 'Ayaya, Caramba !',
		'Japonais' => 'Les livraisons, cela ne pose pas de sushi.',
		'Pizza' => 'Une catégorie a part (!) entière. ',
		'Indien' => 'Cuisine Indienne et pakistanaise.'
		
		);





		foreach($resto as $nom => $desc)
		{
			// On crée la catégorie
			$liste_themes[$nom] = new Theme();
			$liste_themes[$nom]->setNom($nom);

			$liste_themes[$nom]->setDescription($desc);

			// On la persiste
			$manager->persist($liste_categories[$nom]);
		}
		// On déclenche l'enregistrement
		$manager->flush();
	}
}