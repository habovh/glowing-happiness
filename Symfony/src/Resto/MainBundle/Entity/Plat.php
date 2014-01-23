<?php

namespace Resto\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plat
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Resto\MainBundle\Entity\PlatRepository")
 */
class Plat
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
    * @ORM\ManyToOne(targetEntity="Resto\MainBundle\Entity\Restaurant", inversedBy="restaurant")
    * @ORM\JoinColumn(nullable=false)
    */
    private $restaurants;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string")
     */
    private $photo;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Plat
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Plat
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prix
     *
     * @param float $prix
     * @return Plat
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }


    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set Photo
     *
     * @param float $Photo
     * @return photo
     */
    public function setPhoto($Photo)
    {
        $this->photo = $Photo;

        return $this;
    }
    

    /**
     * Get Photo
     *
     * @return float 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

  

    /**
     * Set restaurants
     *
     * @param \Resto\MainBundle\Entity\Restaurant $restaurants
     * @return Plat
     */
    public function setRestaurants(\Resto\MainBundle\Entity\Restaurant $restaurants)
    {
        $this->restaurants = $restaurants;

        return $this;
    }

    /**
     * Get restaurants
     *
     * @return \Resto\MainBundle\Entity\Restaurant 
     */
    public function getRestaurants()
    {
        return $this->restaurants;
    }
}
