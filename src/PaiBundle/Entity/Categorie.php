<?php

namespace PaiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="PaiBundle\Repository\CategorieRepository")
 */
class Categorie
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
     * @var int
     *
     * @ORM\Column(name="Codecategorie", type="integer")
     */
    private $codecategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="Nomcategorie", type="string", length=255)
     */
    private $nomcategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="Famille", type="string", length=255)
     */
    private $famille;
    /**
     * @ORM\OneToMany(targetEntity="PaiBundle\Entity\produit", mappedBy="Categorie",cascade={"remove"}, orphanRemoval=true)
     */
    private $Produit;

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
     * Set codecategorie
     *
     * @param integer $codecategorie
     *
     * @return Categorie
     */
    public function setCodecategorie($codecategorie)
    {
        $this->codecategorie = $codecategorie;

        return $this;
    }

    /**
     * Get codecategorie
     *
     * @return int
     */
    public function getCodecategorie()
    {
        return $this->codecategorie;
    }

    /**
     * Set nomcategorie
     *
     * @param string $nomcategorie
     *
     * @return Categorie
     */
    public function setNomcategorie($nomcategorie)
    {
        $this->nomcategorie = $nomcategorie;

        return $this;
    }

    /**
     * Get nomcategorie
     *
     * @return string
     */
    public function getNomcategorie()
    {
        return $this->nomcategorie;
    }

    /**
     * Set famille
     *
     * @param string $famille
     *
     * @return Categorie
     */
    public function setFamille($famille)
    {
        $this->famille = $famille;

        return $this;
    }

    /**
     * Get famille
     *
     * @return string
     */
    public function getFamille()
    {
        return $this->famille;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Produit = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add produit
     *
     * @param \PaiBundle\Entity\produit $produit
     *
     * @return Categorie
     */
    public function addProduit(\PaiBundle\Entity\produit $produit)
    {
        $this->Produit[] = $produit;

        return $this;
    }

    /**
     * Remove produit
     *
     * @param \PaiBundle\Entity\produit $produit
     */
    public function removeProduit(\PaiBundle\Entity\produit $produit)
    {
        $this->Produit->removeElement($produit);
    }

    /**
     * Get produit
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduit()
    {
        return $this->Produit;
    }
}
