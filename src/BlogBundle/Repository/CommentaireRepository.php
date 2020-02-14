<?php

namespace BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use BlogBundle\Entity\Commentaire;
use BlogBundle\Entity\Post;

class CommentaireRepository extends EntityRepository
{

    /**
     * get post Commentaire
     *
     * @param integer $post_id
     *
     * @return array
     */
    public function getCommentaire($post_id){
        return $this->getEntityManager()
            ->createQuery(
                "SELECT c, u.username
       FROM BlogBundle:Commentaire c
       JOIN c.user u
       WHERE c.post = :id"
            )
            ->setParameter('id', $post_id)
            ->getArrayResult();
    }

}
