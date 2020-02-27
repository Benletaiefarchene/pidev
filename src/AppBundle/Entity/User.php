<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use CommandeBundle\Entity\lignecmd;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use EvenementBundle\Entity\Evenement;
use BlogBundle\BlogBundle;
use BlogBundle\Entity\Commentaire;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Doctrine\Common\Persistence;
use CommandeBundle\CommandeBundle;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="integer")
     */
    protected $idtrans;

    /**
     * @return mixed
     */
    public function getIdtrans()
    {
        return $this->idtrans;
    }

    /**
     * @param mixed $idtrans
     */
    public function setIdtrans($idtrans)
    {
        $this->idtrans = $idtrans;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe",type="string", length=255, columnDefinition="ENUM('male','female')")
     */
    private $sexe;

    /**
     * @var integer
     *
     * @ORM\Column(name="phone_number", type="integer", nullable=true)
     */
    private $phoneNumber;

    /**
     * @var Date
     *
     * @ORM\Column(name="birth_date", type="date", nullable=true)
     */
    private $birthDate;

    /**
     * @ORM\ManyToMany(targetEntity="EvenementBundle\Entity\Evenement",mappedBy="participants")
     */
    private $evenements;

    /**
     * @ORM\ManyToMany(targetEntity="EvenementBundle\Entity\Evenement",mappedBy="interesses")
     */
    private $evenementsInteresse;

    public function __construct()
    {
        parent::__construct();
        $this->lignecmds = new ArrayCollection();
        // your own logic
    }

    /**
     * @return Date
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param Date $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param string $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @return int
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param int $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getEvenements()
    {
        return $this->evenements;
    }

    /**
     * @param mixed $evenements
     */
    public function setEvenements($evenements)
    {
        $this->evenements = $evenements;
    }
    public function addEvenements(Evenement $evenements)
    {
        if (!$this->evenements->contains($evenements)) {
            $this->evenements[] = $evenements;
        }

        return $this;
    }

    public function removeEvenements(Evenement $evenements)
    {
        if ($this->evenements->contains($evenements)) {
            $this->evenements->removeElement($evenements);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEvenementsInteresse()
    {
        return $this->evenementsInteresse;
    }

    /**
     * @param mixed $evenementsInteresse
     */
    public function setEvenementsInteresse($evenementsInteresse)
    {
        $this->evenementsInteresse = $evenementsInteresse;
    }

    public function addEvenementsInteresse(Evenement $evenements)
    {
        if (!$this->evenementsInteresse->contains($evenements)) {
            $this->evenementsInteresse[] = $evenements;
        }

        return $this;
    }

    public function removeEvenementsInteresse(Evenement $evenements)
    {
        if ($this->evenementsInteresse->contains($evenements)) {
            $this->evenementsInteresse->removeElement($evenements);
        }

        return $this;
    }
    /**
     * Many series have Many comm.
     * @ORM\ManyToMany(targetEntity="BlogBundle\Entity\Commentaire", inversedBy="likes")
     * * @ORM\JoinTable(name="likes",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="comm_id", referencedColumnName="id")}
     *      )
     */
    private $commLikes;
    /**
     * @param Commentaire $commentaire
     * @return $this
     */
    public function addComm(\BlogBundle\Entity\Commentaire $comm)
    {
        if (!$this->commLikes->contains($comm )) {
            $this->commLikes[] = $comm;
        }
        return $this;
    }

    /**
     * @param Commentaire $commentaire
     * @return $this
     */
    public function removeComm(\BlogBundle\Entity\Commentaire $comm )
    {
        if ($this->commLikes->contains($comm )) {
            $this->commLikes->removeElement($comm );
        }
        return $this;
    }
    /**
     * @ORM\OneToMany(targetEntity="CommandeBundle\Entity\lignecmd", mappedBy="userid")
     */
    private $lignecmds;

    /**
     * Get lignecmd
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLignecmds()
    {
        return $this->lignecmds;
    }
    /**
     * Set transporteur
     *
     * @param \livraisonBundle\Entity\lignecmd $lignecmd
     *
     * @return lignecmd
     */
    public function addLignecmds(lignecmd $lignecmd)
    {
        if (!$this->lignecmds->contains($lignecmd)) {
            $this->lignecmds[] = $lignecmd;
            $lignecmd->setUserid($this);
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
            if ($lignecmd->getUserid() === $this) {
                $lignecmd->setUserid(null);
            }
        }

        return $this;
    }

}