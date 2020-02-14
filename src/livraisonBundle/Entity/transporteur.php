<?php

namespace livraisonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * transporteur
 *
 * @ORM\Table(name="transporteur")
 * @ORM\Entity(repositoryClass="livraisonBundle\Repository\transporteurRepository")
 */
class transporteur
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var int
     *
     * @ORM\Column(name="tel", type="integer")
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="livraisonBundle\Entity\livraison",mappedBy="transporteur")
     */
    private $livraison;

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
     * Set email
     *
     * @param string $email
     *
     * @return transporteur
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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
     * @param \veloBundle\Entity\livraison $livraison
     *
     * @return transporteur
     */
    public function addLivraison(\veloBundle\Entity\livraison $livraison)
    {
        $this->livraison[] = $livraison;

        return $this;
    }

    /**
     * Remove livraison
     *
     * @param \veloBundle\Entity\livraison $livraison
     */
    public function removeLivraison(\veloBundle\Entity\livraison $livraison)
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
}
