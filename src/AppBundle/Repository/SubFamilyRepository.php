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

class SubFamilyRepository extends EntityRepository
{


    public function createAlphabeticalQueryBuilder()
    {

        return $this->createQueryBuilder('sub_family')
            ->orderBy('sub_family.name', 'ASC');
    }

}