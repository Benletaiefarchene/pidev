<?php

namespace CommandeBundle\Repository;

/**
 * ProduitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduitRepository extends \Doctrine\ORM\EntityRepository
{
    public function getProduitbyPrix()
    {
        $query=$this->getEntityManager()->createQuery("SELECT m FROM CommandeBundle:Produit m 
ORDER BY m.prix DESC");
        return $query->getResult();
    }


}
