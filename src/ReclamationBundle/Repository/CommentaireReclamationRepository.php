<?php
/**
 * Created by PhpStorm.
 * User: Amine
 * Date: 16/04/2019
 * Time: 12:46
 */

namespace ReclamationBundle\Repository;
use Doctrine\ORM\EntityRepository;


class CommentaireReclamationRepository extends EntityRepository
{

    public function findComments($id)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT a FROM ReclamationBundle:CommentReclamation a WHERE a.fkReclamation=".$id." ORDER BY a.dateInsertionCommentaireReclamation    DESC");
        return $query->getResult();
    }

}