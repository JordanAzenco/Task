<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;



class TaskRepository extends EntityRepository
{
  
    public function findAllOrderByDescAndId($id_user)
    {
        // automatically knows to select Products
        // the "p" is an alias you'll use in the rest of the query

       /*   $qb = $this->createQueryBuilder('t')
            ->orderBy('t.dueDate', 'DESC')
            ->getQuery();  */

            $qb = $this->createQueryBuilder('t')
            ->innerJoin('t.users', 'u')
            ->where('u.id = :id')
            ->orderBy('t.dueDate', 'DESC')
            ->setParameter('id', $id_user)
            ->getQuery(); 
            

        return $qb->execute();

        // to get just one result:
        // $product = $qb->setMaxResults(1)->getOneOrNullResult();
    }
}