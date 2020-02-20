<?php

namespace EvenementBundle\Entity;

use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="EvenementBundle\Repository\EvenementRepository")
 */
class Evenement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_evenement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_evenement", type="string", length=255, nullable=false)
     */
    private $nomEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_evenement", type="string", length=255, nullable=false)
     */
    private $typeEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="Lieu_evenement", type="string", length=255, nullable=false)
     */
    private $lieuEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=false)
     */
    private $description;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_evenement", type="date", nullable=true)
     */
    private $dateEvenement;


    /**
     * @var string
     *
     * @ORM\Column(name="Etat",type="string", length=255, columnDefinition="ENUM('pending', 'Active', 'Disabled','Expired')")
     */
    private $etat;


    /**
     * @ORM\ManyToOne(targetEntity="EvenementBundle\Entity\Categorie", inversedBy="Evenement")
     * @ORM\JoinColumn(name="categorie",referencedColumnName="id_categorie")
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", inversedBy="evenements")
     * @ORM\JoinTable(name="participant",
     *      joinColumns={@ORM\JoinColumn(name="id_evenement", referencedColumnName="id_evenement")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     *      )
     */
    private $participants;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", inversedBy="evenementsInteresse")
     * @ORM\JoinTable(name="interesse",
     *      joinColumns={@ORM\JoinColumn(name="id_evenement", referencedColumnName="id_evenement")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     *      )
     */
    private $interesses;
    /**
     * @return int
     */
    public function getIdEvenement()
    {
        return $this->idEvenement;
    }

    /**
     * @param int $idEvenement
     */
    public function setIdEvenement($idEvenement)
    {
        $this->idEvenement = $idEvenement;
    }

    /**
     * @return string
     */
    public function getNomEvenement()
    {
        return $this->nomEvenement;
    }

    /**
     * @param string $nomEvenement
     */
    public function setNomEvenement($nomEvenement)
    {
        $this->nomEvenement = $nomEvenement;
    }

    /**
     * @return string
     */
    public function getTypeEvenement()
    {
        return $this->typeEvenement;
    }

    /**
     * @param string $typeEvenement
     */
    public function setTypeEvenement($typeEvenement)
    {
        $this->typeEvenement = $typeEvenement;
    }

    /**
     * @return string
     */
    public function getLieuEvenement()
    {
        return $this->lieuEvenement;
    }

    /**
     * @param string $lieuEvenement
     */
    public function setLieuEvenement($lieuEvenement)
    {
        $this->lieuEvenement = $lieuEvenement;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getDateEvenement()
    {
        return $this->dateEvenement;
    }

    /**
     * @param \DateTime $dateEvenement
     */
    public function setDateEvenement($dateEvenement)
    {
        $this->dateEvenement = $dateEvenement;
    }





    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }


    /**
     * Set idCategorie
     *
     * @param \EvenementBundle\Entity\Categorie $idCategorie
     *
     * @return Evenement
     */
    public function setIdCategorie(\EvenementBundle\Entity\Categorie $idCategorie = null)
    {
        $this->id_categorie = $idCategorie;

        return $this;
    }

    /**
     * Get idCategorie
     *
     * @return \EvenementBundle\Entity\Categorie
     */
    public function getIdCategorie()
    {
        return $this->id_categorie;
    }

    /**
     * Set categorie
     *
     * @param \EvenementBundle\Entity\Categorie $categorie
     *
     * @return Evenement
     */
    public function setCategorie(\EvenementBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \EvenementBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @return mixed
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * @param mixed $participants
     */
    public function setParticipants($participants)
    {
        $this->participants = $participants;
    }

    public function addParticipants(User $user)
    {
        if (!$this->participants->contains($user)) {
            $this->participants[] = $user;
        }

        return $this;
    }

    public function removeParticipants(User $user)
    {
        if ($this->participants->contains($user)) {
            $this->participants->removeElement($user);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInteresses()
    {
        return $this->interesses;
    }

    /**
     * @param mixed $interesses
     */
    public function setInteresses($interesses)
    {
        $this->interesses = $interesses;
    }

    public function addInteresses(User $user)
    {
        if (!$this->interesses->contains($user)) {
            $this->interesses[] = $user;
        }

        return $this;
    }

    public function removeInteresses(User $user)
    {
        if ($this->interesses->contains($user)) {
            $this->interesses->removeElement($user);
        }

        return $this;
    }

}
