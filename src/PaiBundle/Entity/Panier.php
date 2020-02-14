<?php

namespace PaiBundle\Entity;
use PaiBundle\Entity\Commande;
use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="panier")
 * @ORM\Entity(repositoryClass="PaiBundle\Repository\PanierRepository")
 */
class Panier
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
     * @ORM\Column(name="Quantite_commandee", type="integer")
     */
    private $quantiteCommandee;
     /**
     * @ORM\OneToMany(targetEntity="PaiBundle\Entity\Produit", mappedBy="Panier",cascade={"remove"}, orphanRemoval=true)
     */
    private $Produit;
    /**
     * One Customer has One Cart.
     * @ORM\OneToOne(targetEntity="Commande", mappedBy="Panier")
     */
    private $Commande;
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
     * Set quantiteCommandee
     *
     * @param integer $quantiteCommandee
     *
     * @return Panier
     */
    public function setQuantiteCommandee($quantiteCommandee)
    {
        $this->quantiteCommandee = $quantiteCommandee;

        return $this;
    }

    /**
     * Get quantiteCommandee
     *
     * @return int
     */
    public function getQuantiteCommandee()
    {
        return $this->quantiteCommandee;
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
     * @param \PaiBundle\Entity\Produit $produit
     *
     * @return Panier
     */
    public function addProduit(\PaiBundle\Entity\Produit $produit)
    {
        $this->Produit[] = $produit;

        return $this;
    }

    /**
     * Remove produit
     *
     * @param \PaiBundle\Entity\Produit $produit
     */
    public function removeProduit(\PaiBundle\Entity\Produit $produit)
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

    /**
     * Set commande
     *
     * @param \PaiBundle\Entity\Commande $commande
     *
     * @return Panier
     */
    public function setCommande(\PaiBundle\Entity\Commande $commande = null)
    {
        $this->Commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \PaiBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->Commande;
    }
}
