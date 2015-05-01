<?php

namespace Kamran\LinkBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * BulkLinksRepository
 *
 */
class BulkLinksRepository extends EntityRepository
{

    public function findByLists(){
        $query = $this->getEntityManager()
            ->createQuery("SELECT l FROM KamranLinkBundle:BulkLinks l ORDER BY l.id DESC");


        return $query->getResult();
    }


    public function findLinkByListname($listname){
        $qb  = $this->getEntityManager()->createQueryBuilder();
        $qb->select('l.id,l.link,l.name')
            ->from('KamranLinkBundle:BulkLinks', 'l')
            ->where('l.name = :list ')
            ->setParameter('list', $listname)
        ;
         return $qb->getQuery()->getResult();
    }

    public function getItemList(){
        $qb  = $this->getEntityManager()->createQueryBuilder();
        $qb->select('l.name')
            ->from('KamranLinkBundle:BulkLinks', 'l')
            ->groupBy('l.name');
        $foundLists = $qb->getQuery()->getResult();
        $list = array();
        foreach($foundLists as $lst){
            $listname = trim($lst['name']);
            if( $listname != ''){
                $list[$listname] = $listname;
            }
        }
        return $list;
    }


}//@