<?php

namespace Dragonfly\CommonBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;


/**
 * UserRepository
 *
 */
class UserRepository extends EntityRepository
{
    public function findAllOrderedByUsername() {

        $qb = $this->createQueryBuilder('u');

        $qb->orderBy('u.username', 'ASC');
        //$qb->setMaxResults( 100 );

        return $qb;
    }
}