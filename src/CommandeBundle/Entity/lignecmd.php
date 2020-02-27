<?php

namespace CommandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * lignecmd
 *
 * @ORM\Table(name="lignecmd")
 * @ORM\Entity(repositoryClass="CommandeBundle\Repository\lignecmdRepository")
 */
class lignecmd
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
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;
    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;

    /**
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param int $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }
    /**
     * @ORM\ManyToOne(targetEntity="CommandeBundle\Entity\cmd")
     *
     * @ORM\JoinColumn(name="cmd_id", referencedColumnName="id")
     *
     */
    private $cmd;



    /**
     * @ORM\ManyToOne(targetEntity="CommandeBundle\Entity\Produit")
     *
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     *
     */
    private $produit;

    /**
     * @return mixed
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * @param mixed $produit
     */
    public function setProduit($produit)
    {
        $this->produit = $produit;
    }


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     *
     * @ORM\JoinColumn(name="userid", referencedColumnName="id")
     *
     */
    private $userid;

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return lignecmd
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }
}

