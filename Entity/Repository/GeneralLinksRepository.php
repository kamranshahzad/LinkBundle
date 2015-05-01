<?php

namespace Kamran\LinkBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class GeneralLinksRepository extends EntityRepository
{

    public function findGeneralLinks($data){

        $em =$this->getEntityManager();
        //$dql = "SELECT gl,tl FROM KamranLinkBundle:GeneralLinks gl JOIN gl.tags tl WHERE tl.tag_id = 13";


        //$parameters = array(1 => 2, 2 => 41);

        /*
        $dql = 'SELECT gl FROM KamranLinkBundle:GeneralLinks gl LEFT JOIN gl.tags ts WHERE ts.id IN (?'.implode(', ?', array_keys($parameters)).')';
        $query = $em->createQuery($dql)->setParameters($parameters);
        $result = $query->getResult();
        */

        $result = $this->createQueryBuilder('gl')
            ->select('gl, tl')
            ->leftJoin('gl.tags', 'tl')->where('tl.id IN (:ids)')->setParameter('ids', $data)
            ->getQuery()->getResult();

        $array = array();
        foreach($result as $object){
            $array[] = $object->getUrl();
        }
        return $array;
    }


/*    public function findByGroup(){
        $result = $this->createQueryBuilder('t')
            ->select('t , tt ')
            ->leftJoin('t.technology', 'tt')->orderBy('t.technology')
            ->getQuery()->getResult();
        $groupArray = array();
        $groupData  = array();
        foreach($result as $object){
            $groupArray[$object->getTechnology()->getName()][$object->getId()] = $object->getName();
            $groupData[$object->getTechnology()->getName()] = $object->getTechnology()->getId();
        }
        $resultArray = array('data'=>$groupData , 'options'=>$groupArray);
        return $resultArray;
    }*/

	/*public function findCodeByTags($tagid){

        return $this->createQueryBuilder('p')
            ->select('p , tt ')
            ->leftJoin('p.tags', 'tt')
            ->where('tt.id = :id')->setParameter('id', $tagid)
            ->getQuery()->getResult();

	}*/


}