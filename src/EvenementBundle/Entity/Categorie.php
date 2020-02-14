<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="EvenementBundle\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_categorie", type="integer")
     * @ORM\Id
     */
    private $id_categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="EvenementBundle\Entity\Evenement",mappedBy="Categorie")
     */
    private $idEvenement;

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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Categorie
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set idCategorie
     *
     * @param integer $idCategorie
     *
     * @return Categorie
     */
    public function setIdCategorie($idCategorie)
    {
        $this->id_categorie = $idCategorie;

        return $this;
    }

    /**
     * Get idCategorie
     *
     * @return integer
     */
    public function getIdCategorie()
    {
        return $this->id_categorie;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Evenement = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add evenement
     *
     * @param \EvenementBundle\Entity\Evenement $evenement
     *
     * @return Categorie
     */
    public function addEvenement(\EvenementBundle\Entity\Evenement $evenement)
    {
        $this->Evenement[] = $evenement;

        return $this;
    }

    /**
     * Remove evenement
     *
     * @param \EvenementBundle\Entity\Evenement $evenement
     */
    public function removeEvenement(\EvenementBundle\Entity\Evenement $evenement)
    {
        $this->Evenement->removeElement($evenement);
    }

    /**
     * Get evenement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvenement()
    {
        return $this->Evenement;
    }
}
