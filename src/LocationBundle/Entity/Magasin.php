<?php

namespace LocationBundle\Entity;

use AppBundle\Entity\Notification;
use Doctrine\ORM\Mapping as ORM;
use Mgilet\NotificationBundle\NotifiableInterface;
use SBC\NotificationsBundle\Builder\NotificationBuilder;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * MagasinController
 *
 * @ORM\Table(name="magasin")
 * @ORM\Entity(repositoryClass="LocationBundle\Repository\MagasinRepository")
 */
class Magasin implements \SBC\NotificationsBundle\Model\NotifiableInterface
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
     *  @Assert\NotBlank()
     */
    private $nameM;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="tel", type="integer")
     *  @Assert\NotBlank()
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

    public function notificationsOnUpdate(NotificationBuilder $builder)
    {
        $notification = new Notification();
        $notification
            ->setTitle('update magasin')
            ->setDescription($this->getNameM())
            ->setRoute('Magasin_list')// I suppose you have a show route for your entity
            ->setParameters(array('id' => $this->getId()))
        ;
        $builder->addNotification($notification);

        return $builder;
    }

    public function notificationsOnDelete(NotificationBuilder $builder)
    {
        return $builder;
    }

    public function notificationsOnCreate(NotificationBuilder $builder)
    {
        $notification = new Notification();
        $notification
            ->setTitle('New magasin')
            ->setDescription($this->getNameM())
            ->setRoute('Magasin_list')// I suppose you have a show route for your entity
            ->setParameters(array('id' => $this->getId()))
        ;
        $builder->addNotification($notification);

        return $builder;
    }
}

