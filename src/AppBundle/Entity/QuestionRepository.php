<?php

namespace AppBundle\Entity;

use AppBundle\Entity\ExtendRepository;
use AppBundle\Entity\Question;

/**
 * QuestionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class QuestionRepository extends ExtendRepository
{
    public function findAllByParentId($parentId) {
        try {
            return $query = $this->getEntityManager()
                ->createQueryBuilder()
                ->select('q')
                ->from('AppBundle:Question', 'q')
                ->innerJoin('AppBundle:Test', 't')
                ->where('t.id = :testId')
                ->setParameter('testId', $parentId)
                ->getQuery()
                ->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return $e;
        }

    }
}