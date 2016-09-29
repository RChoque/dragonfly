<?php

namespace Dragonfly\BugTrackerBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;


/**
 * BugRepository
 *
 */
class BugRepository extends EntityRepository
{
    public function findAllPagination() {

        $qb = $this->createQueryBuilder('b');
        $query = $qb->getQuery();

        return $query;
    }

    public function findAllByProject($project_slug) {

        $qb = $this->createQueryBuilder('b');
        $query = $qb->getQuery();

        return $query;
    }
}