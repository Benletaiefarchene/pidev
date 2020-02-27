<?php

namespace livraisonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormTypeInterface;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * transporteur
 *
 * @ORM\Table(name="transporteur")
 * @ORM\Entity(repositoryClass="livraisonBundle\Repository\transporteurRepository")
 */
class transporteur extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    protected $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    protected $prenom;

    /**
     * @var int
     *
     * @ORM\Column(name="tel", type="integer")
     */
    protected $tel;


    /**
     * @var int
     *
     * @ORM\Column(name="capacite", type="integer")
     */
    protected $capacite;



    /**
     * @ORM\OneToMany(targetEntity="livraisonBundle\Entity\livraison",mappedBy="transporteur")
     */
    protected $livraison;

    /**
     * @var bool
     *
     * @ORM\Column(name="dispo", type="boolean")
     */
    protected $dispo;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return transporteur
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return transporteur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set tel
     *
     * @param integer $tel
     *
     * @return transporteur
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return int
     */
    public function getTel()
    {
        return $this->tel;
    }



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->livraison = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add livraison
     *
     * @param \livraisonBundle\Entity\livraison $livraison
     *
     * @return transporteur
     */
    public function addLivraison(\livraisonBundle\Entity\livraison $livraison)
    {
        $this->livraison[] = $livraison;

        return $this;
    }

    /**
     * Remove livraison
     *
     * @param \livraisonBundle\Entity\livraison $livraison
     */
    public function removeLivraison(\livraisonBundle\Entity\livraison $livraison)
    {
        $this->livraison->removeElement($livraison);
    }

    /**
     * Get livraison
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLivraison()
    {
        return $this->livraison;
    }

    /**
     * @return bool
     */
    public function isDispo()
    {
        return $this->dispo;
    }

    /**
     * @param bool $dispo
     */
    public function setDispo($dispo)
    {
        $this->dispo = $dispo;
    }

    /**
     * @return int
     */
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * @param int $capacite
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;
    }


}
