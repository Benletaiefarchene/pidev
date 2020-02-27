<?php


namespace LocationBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Region
 *
 * @ORM\Table(name="Region")
 * @ORM\Entity(repositoryClass="LocationBundle\Repository\regionRepository")
 */
class Region
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_reg", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_reg;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;


    /**
     * Get id
     *
     * @return int
     */
    public function getid_reg()
    {
        return $this->id_reg;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Region
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


}