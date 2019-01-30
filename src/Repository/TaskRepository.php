<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;



class TaskRepository extends EntityRepository
{
  
    public function findAllOrderByDesc()
    {
        // automatically knows to select Products
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('t')
            ->orderBy('t.dueDate', 'DESC')
            ->getQuery();

        return $qb->execute();

        // to get just one result:
        // $product = $qb->setMaxResults(1)->getOneOrNullResult();
    }
}