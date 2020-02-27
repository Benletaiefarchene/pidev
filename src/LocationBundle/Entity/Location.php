<?php

namespace LocationBundle\Entity;

use AppBundle\Entity\Notification;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use SBC\NotificationsBundle\Builder\NotificationBuilder;
/**
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity(repositoryClass="LocationBundle\Repository\LocationRepository")
 */
class Location implements \SBC\NotificationsBundle\Model\NotifiableInterface
{

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
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
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumn(name="id_Produit",referencedColumnName="id")
     *
     */
    private $id_Produit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_l", type="date")
     * @Assert\GreaterThanOrEqual("today")
     */
    private $start_l;

    /**
     * @return mixed
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param mixed $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     *
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;


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


    public function notificationsOnCreate(NotificationBuilder $builder)
    {
        $notification = new Notification();
        $notification
            ->setTitle('new location')
            ->setDescription($this->getIdProduit()->getRefProduit())
            ->setRoute('Location_list')// I suppose you have a show route for your entity
            ->setParameters(array('id' => $this->getIdLoc()))
        ;
        $builder->addNotification($notification);

        return $builder;
    }

    public function notificationsOnUpdate(NotificationBuilder $builder)
    {
        $notification = new Notification();
        $notification
            ->setTitle('new location')
            ->setDescription($this->getIdProduit()->getRefProduit())
            ->setRoute('Location_list')// I suppose you have a show route for your entity
            ->setParameters(array('id' => $this->getIdLoc()))
        ;
        $builder->addNotification($notification);

        return $builder;
    }

    public function notificationsOnDelete(NotificationBuilder $builder)
    {
        return $builder;
    }
}

