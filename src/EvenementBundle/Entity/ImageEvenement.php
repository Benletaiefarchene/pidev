<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * ImageEvenement
 *
 * @ORM\Table(name="image_evenement")
 * @ORM\Entity(repositoryClass="EvenementBundle\Repository\ImageEvenementRepository")
 */
class ImageEvenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_image", type="integer")
     * @ORM\Id
     */
    private $id_image;

    /**
     * @var string
     *
     * @ORM\Column(name="urlImage", type="string", length=255)
     */
    private $urlImage;

    /**
     * @ORM\ManyToOne(targetEntity="EvenementBundle\Entity\Evenement",inversedBy="ImageEvenemenet")
     * @ORM\JoinColumn(name="Evenement",referencedColumnName="id_evenement")
     */
    private $Evenement;
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
     * Set urlImage
     *
     * @param string $urlImage
     *
     * @return ImageEvenement
     */
    public function setUrlImage($urlImage)
    {
        $this->urlImage = $urlImage;

        return $this;
    }

    /**
     * Get urlImage
     *
     * @return string
     */
    public function getUrlImage()
    {
        return $this->urlImage;
    }

    /**
     * @Assert\File(maxSize="500k")
     */
    public $file;
    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_evenement", referencedColumnName="id_evenement")
     * })
     */
    private $id_evenement;


    /**
     * Set idImage
     *
     * @param integer $idImage
     *
     * @return ImageEvenement
     */
    public function setIdImage($idImage)
    {
        $this->id_image = $idImage;

        return $this;
    }

    /**
     * Get idImage
     *
     * @return integer
     */
    public function getIdImage()
    {
        return $this->id_image;
    }

    /**
     * Set idEvenement
     *
     * @param \EvenementBundle\Entity\Evenement $idEvenement
     *
     * @return ImageEvenement
     */
    public function setIdEvenement(\EvenementBundle\Entity\Evenement $idEvenement = null)
    {
        $this->id_evenement = $idEvenement;

        return $this;
    }

    /**
     * Get idEvenement
     *
     * @return \EvenementBundle\Entity\Evenement
     */
    public function getIdEvenement()
    {
        return $this->id_evenement;
    }

    /**
     * Set evenement
     *
     * @param \EvenementBundle\Entity\Evenement $evenement
     *
     * @return ImageEvenement
     */
    public function setEvenement(\EvenementBundle\Entity\Evenement $evenement = null)
    {
        $this->Evenement = $evenement;

        return $this;
    }

    /**
     * Get evenement
     *
     * @return \EvenementBundle\Entity\Evenement
     */
    public function getEvenement()
    {
        return $this->Evenement;
    }
}
