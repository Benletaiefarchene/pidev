<?php

namespace LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity(repositoryClass="LocationBundle\Repository\LocationRepository")
 */
class Location
{
    /**
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="id_client",referencedColumnName="id")
     *
     */
    private $id_client;

    /**
     * @return int
     */
    public function getIdLoc()
    {
        return $this->id_loc;
    }

    /**
     * @param int $id_loc
     */
    public function setIdLoc($id_loc)
    {
        $this->id_loc = $id_loc;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id_loc", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_loc;

    /**
     * @return mixed
     */
    public function getIdProduit()
    {
        return $this->id_Produit;
    }

    /**
     * @param mixed $id_Produit
     */
    public function setIdProduit($id_Produit)
    {
        $this->id_Produit = $id_Produit;
    }
    /**
     *
     * @ORM\OneToOne(targetEntity="Produit")
     * @ORM\JoinColumn(name="id_Produit",referencedColumnName="id")
     *
     */
    private $id_Produit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_l", type="date")
     */
    private $start_l;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_l", type="date")
     */
    private $end_l;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id_loc;
    }


    public function getIdClient()
    {
        return $this->id_client;
    }

    /**
     * @return \DateTime
     */
    public function getStartL()
    {
        return $this->start_l;
    }

    /**
     * @param \DateTime $start_l
     */
    public function setStartL($start_l)
    {
        $this->start_l = $start_l;
    }

    /**
     * @param mixed $id_client
     */
    public function setIdClient($id_client)
    {
        $this->id_client = $id_client;
    }

    /**
     * @return \DateTime
     */
    public function getEndL()
    {
        return $this->end_l;
    }

    /**
     * @param \DateTime $end_l
     */
    public function setEndL($end_l)
    {
        $this->end_l = $end_l;
    }


}

