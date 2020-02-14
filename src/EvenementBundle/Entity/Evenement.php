<?php

namespace EvenementBundle\Entity;

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
     * @var integer
     *
     * @ORM\Column(name="NB_participant", type="integer", nullable=true)
     */
    private $nbParticipant = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="Date_evenement", type="string", length=255, nullable=true)
     */
    private $dateEvenement;

    /**
     * @var integer
     *
     * @ORM\Column(name="NB_interesser", type="integer", nullable=true)
     */
    private $nbInteresser = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="Etat", type="string", length=255, nullable=true)
     */
    private $etat = 'D';


    /**
     * @ORM\ManyToOne(targetEntity="EvenementBundle\Entity\Categorie", inversedBy="Evenement")
     * @ORM\JoinColumn(name="categorie",referencedColumnName="id_categorie")
     */
    private $categorie;

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
     * @return int
     */
    public function getNbParticipant()
    {
        return $this->nbParticipant;
    }

    /**
     * @param int $nbParticipant
     */
    public function setNbParticipant($nbParticipant)
    {
        $this->nbParticipant = $nbParticipant;
    }

    /**
     * @return string
     */
    public function getDateEvenement()
    {
        return $this->dateEvenement;
    }

    /**
     * @param string $dateEvenement
     */
    public function setDateEvenement($dateEvenement)
    {
        $this->dateEvenement = $dateEvenement;
    }



    /**
     * @return int
     */
    public function getNbInteresser()
    {
        return $this->nbInteresser;
    }

    /**
     * @param int $nbInteresser
     */
    public function setNbInteresser($nbInteresser)
    {
        $this->nbInteresser = $nbInteresser;
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
     * @return \Utilisateur
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * @param \Utilisateur $idUtilisateur
     */
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
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
}
