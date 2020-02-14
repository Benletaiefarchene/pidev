<?php

namespace PaiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="PaiBundle\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Refproduit", type="string", length=255)
     */
    private $refproduit;

    /**
     * @var string
     *
     * @ORM\Column(name="Designation", type="string", length=255)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="Prix", type="string", length=255)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="Image", type="string", length=255)
     */
    private $image;
    /**
     * @ORM\ManyToOne(targetEntity="PaiBundle\Entity\Categorie", inversedBy="Produit")
     * @ORM\JoinColumn(name="Categorie", referencedColumnName="id")
     */
    private $Categorie;
    /**
     * @ORM\ManyToOne(targetEntity="PaiBundle\Entity\Panier", inversedBy="Produit")
     * @ORM\JoinColumn(name="Panier", referencedColumnName="id")
     */
    private $Panier;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set refproduit
     *
     * @param string $refproduit
     *
     * @return Produit
     */
    public function setRefproduit($refproduit)
    {
        $this->refproduit = $refproduit;

        return $this;
    }

    /**
     * Get refproduit
     *
     * @return string
     */
    public function getRefproduit()
    {
        return $this->refproduit;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return Produit
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produit
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
     *
     * @return Produit
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
     * Set image
     *
     * @param string $image
     *
     * @return Produit
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set categorie
     *
     * @param \PaiBundle\Entity\Categorie $categorie
     *
     * @return Produit
     */
    public function setCategorie(\PaiBundle\Entity\Categorie $categorie = null)
    {
        $this->Categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \PaiBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->Categorie;
    }
}
