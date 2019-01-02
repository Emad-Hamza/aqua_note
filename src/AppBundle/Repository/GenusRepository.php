<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud S. Siddiq
 * Date: 02-Jan-19
 * Time: 8:19 PM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Genus;
use Doctrine\ORM\EntityRepository;

class GenusRepository extends EntityRepository
{

    /**
     * @return Genus[]
     */
    function findAllPublishedOrderedBySize()
    {
        return $this->createQueryBuilder('genus')
            ->andWhere('genus.isPublished = :isPublished')
            ->setParameter('isPublished', true)
            ->orderBy('genus.speciesCount', 'DESC')
            ->getQuery()
            ->execute();
    }

}