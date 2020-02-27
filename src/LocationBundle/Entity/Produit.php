<?php

namespace LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="LocationBundle\Repository\ProduitRepository")
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
     *
     * @ORM\ManyToOne(targetEntity="Magasin")
     * @ORM\JoinColumn(name="id_Magasin",referencedColumnName="id")
     *
     */
    private $id_Magasin;

    /**
     * @var string
     *
     * @ORM\Column(name="Ref_produit", type="string", length=255)
     */
    private $refProduit;

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
     * @return bool
     */
    public function isDisponible()
    {
        return $this->Disponible;
    }

    /**
     * @param bool $Disponible
     */
    public function setDisponible($Disponible)
    {
        $this->Disponible = $Disponible;
    }
    /**
     * @var bool
     *
     * @ORM\Column(name="Disponible", type="boolean")
     */
    private $Disponible;

    /**
     * @return mixed
     */
    public function getIdMagasin()
    {
        return $this->id_Magasin;
    }

    /**
     * @param mixed $id_Magasin
     */
    public function setIdMagasin($id_Magasin)
    {
        $this->id_Magasin = $id_Magasin;
    }

    /**
     * @var float
     *
     * @ORM\Column(name="Prix", type="float")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text")
     */
    private $image;

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return mixed
     */
    public function getPrixHeure()
    {
        return $this->prix_heure;
    }

    /**
     * @param mixed $prix_heure
     */
    public function setPrixHeure($prix_heure)
    {
        $this->prix_heure = $prix_heure;
    }

    /**
     *
     * @ORM\Column(name="Statut", type="boolean")
     */
    private $statut;

    /**
     *
     * @ORM\Column(name="prix_heure", type="float")
     */
    private $prix_heure;


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
     * Set refProduit
     *
     * @param string $refProduit
     *
     * @return Produit
     */
    public function setRefProduit($refProduit)
    {
        $this->refProduit = $refProduit;

        return $this;
    }

    /**
     * Get refProduit
     *
     * @return string
     */
    public function getRefProduit()
    {
        return $this->refProduit;
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


}

