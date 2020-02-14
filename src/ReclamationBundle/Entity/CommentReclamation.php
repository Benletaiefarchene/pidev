<?php
/**
 * Created by PhpStorm.
 * User: Amine
 * Date: 16/04/2019
 * Time: 12:43
 */

namespace ReclamationBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * CommentReclamation
 *
 * @ORM\Table(name="CommentReclamation", indexes={@ORM\Index(name="fk_commentaire_reclamation", columns={"fk_reclamation"}), @ORM\Index(name="fk_cmnt_rec_user", columns={"fk_utilisateur"})})
 * @ORM\Entity(repositoryClass="ReclamationBundle\Repository\CommentaireReclamationRepository")
 */
class CommentReclamation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_commentaire_reclamation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCommentaireReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255, nullable=false)
     */
    private $contenu;

    /**
     * @var integer
     *
     * @ORM\Column(name="somme_notes", type="integer", nullable=true)
     */
    private $sommeNotes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_insertion_commentaire_reclamation", type="date", nullable=true)
     */
    private $dateInsertionCommentaireReclamation;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="fk_utilisateur", referencedColumnName="id", onDelete="CASCADE")
     */
    private $fkUtilisateur;


    /**
     * @ORM\ManyToOne(targetEntity="ReclamationBundle\Entity\Reclamation")
     * @ORM\JoinColumn(name="fk_reclamation", referencedColumnName="id", onDelete="CASCADE")
     */

    private $fkReclamation;

    /**
     * @return int
     */
    public function getIdCommentaireReclamation()
    {
        return $this->idCommentaireReclamation;
    }

    /**
     * @param int $idCommentaireReclamation
     */
    public function setIdCommentaireReclamation($idCommentaireReclamation)
    {
        $this->idCommentaireReclamation = $idCommentaireReclamation;
    }

    /**
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return int
     */
    public function getSommeNotes()
    {
        return $this->sommeNotes;
    }

    /**
     * @param int $sommeNotes
     */
    public function setSommeNotes($sommeNotes)
    {
        $this->sommeNotes = $sommeNotes;
    }

    /**
     * @return \DateTime
     */
    public function getDateInsertionCommentaireReclamation()
    {
        return $this->dateInsertionCommentaireReclamation;
    }

    /**
     * @param \DateTime $dateInsertionCommentaireReclamation
     */
    public function setDateInsertionCommentaireReclamation($dateInsertionCommentaireReclamation)
    {
        $this->dateInsertionCommentaireReclamation = $dateInsertionCommentaireReclamation;
    }

    /**
     * @return mixed
     */
    public function getFkUtilisateur()
    {
        return $this->fkUtilisateur;
    }

    /**
     * @param mixed $fkUtilisateur
     */
    public function setFkUtilisateur($fkUtilisateur)
    {
        $this->fkUtilisateur = $fkUtilisateur;
    }

    /**
     * @return mixed
     */
    public function getFkReclamation()
    {
        return $this->fkReclamation;
    }

    /**
     * @param mixed $fkReclamation
     */
    public function setFkReclamation($fkReclamation)
    {
        $this->fkReclamation = $fkReclamation;
    }



}