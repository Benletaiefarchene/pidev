<?php

namespace LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MagasinController
 *
 * @ORM\Table(name="magasin")
 * @ORM\Entity(repositoryClass="LocationBundle\Repository\MagasinRepository")
 */
class Magasin
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
     * @ORM\ManyToOne(targetEntity="Region")
     * @ORM\JoinColumn(name="id_region",referencedColumnName="id_reg")
     *
     */
    private $id_region;

    /**
     * @return mixed
     */
    public function getIdRegion()
    {
        return $this->id_region;
    }

    /**
     * @param mixed $id_region
     */
    public function setIdRegion($id_region)
    {
        $this->id_region = $id_region;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="name_M", type="string", length=255)
     */
    private $nameM;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="tel", type="integer")
     */
    private $tel;


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
     * Set nameM
     *
     * @param string $nameM
     *
     * @return Magasin
     */
    public function setNameM($nameM)
    {
        $this->nameM = $nameM;

        return $this;
    }

    /**
     * Get nameM
     *
     * @return string
     */
    public function getNameM()
    {
        return $this->nameM;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Magasin
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set tel
     *
     * @param integer $tel
     *
     * @return Magasin
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
}

