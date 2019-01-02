<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud S. Siddiq
 * Date: 24-Dec-18
 * Time: 3:25 PM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Genus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Nelmio\Alice\Fixtures;
use Nelmio\Alice\FixtureSet;
use Nelmio\Alice\Loader\NativeLoader;

class LoadFixtures implements ORMFixtureInterface
{
    public function load(ObjectManager $manager)
    {



        Fixtures::load(__DIR__.'/fixtures.yml',
            $manager,

            [
                'providers' => [$this]
            ]
            );

    }

    public function genus()
    {
        $genera = [
            'Octopus',
            'Balaena',
            'Orcinus',
            'Hippocampus',
            'Asterias',
            'Amphiprion',
            'Carcharodon',
            'Aurelia',
            'Cucumaria',
            'Balistoides',
            'Paralithodes',
            'Chelonia',
            'Trichechus',
            'Eumetopias'
        ];
        $key = array_rand($genera);
        return $genera[$key];
    }



}