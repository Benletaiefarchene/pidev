<?php

namespace CommandeBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * cmd
 *
 * @ORM\Table(name="cmd")
 * @ORM\Entity(repositoryClass="CommandeBundle\Repository\cmdRepository")
 */
class cmd
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
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer")
     */
    private $telephone;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     *
     * @ORM\JoinColumn(name="userid", referencedColumnName="id")
     *
     */
    private $userid;

    /**
     * @ORM\OneToMany(targetEntity="CommandeBundle\Entity\lignecmd", mappedBy="cmd")
     */
    private $lignecmds;


    public function __construct()
    {
        $this->lignecmds = new ArrayCollection();
    }
    /**
     * Get Lignecmds
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLignecmds()
    {
        return $this->lignecmds;
    }
    /**
     * Add livraison
     *
     * @param \livraisonBundle\Entity\lignecmd $lignecmd
     *
     * @return lignecmd
     */
    public function addLignecmds(lignecmd $lignecmd)
    {
        if (!$this->lignecmds->contains($lignecmd)) {
            $this->lignecmds[] = $lignecmd;
            $lignecmd->setCmd($this);
        }

        return $this;
    }
    /**
     * Remove livraison
     *
     * @param \livraisonBundle\Entity\lignecmd $lignecmd
     */
    public function removeLignecmds
    (lignecmd $lignecmd)
    {
        if ($this->lignecmds->contains($lignecmd)) {
            $this->lignecmds->removeElement($lignecmd);
            // set the owning side to null (unless already changed)
            if ($lignecmd->getCmd() === $this) {
                $lignecmd->setCmd(null);
            }
        }

        return $this;
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
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

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
     * Set prix
     *
     * @param integer $prix
     *
     * @return cmd
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return cmd
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return int
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return cmd
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
}

