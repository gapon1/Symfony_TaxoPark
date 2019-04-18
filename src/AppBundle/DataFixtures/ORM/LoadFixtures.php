<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-03-28
 * Time: 18:32
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        Fixtures::load(__DIR__ . '/fixtures.yml',
            $manager,
            [
                'providers' => [$this]
            ]
        );
    }

    public function carName(): array
    {
        $generate = ['BMW-1', 'BMW-2', 'BMW-3', 'BMW-4', 'BMW-5', 'BMW-6', 'BMW-7'];
        $key = array_rand($generate);
        return $generate[$key];
    }

    public function carType(): array
    {
        $generate = ['Universal', 'Economy', 'Premium', 'Luxury'];
        $key = array_rand($generate);
        return $generate[$key];
    }

    public function status(): array
    {
        $generate = ['call', 'waiting', 'satDown', 'finished'];
        $key = array_rand($generate);
        return $generate[$key];
    }

    public function role(): array
    {
        $generate = ['ADMIN', 'CUSTOMER', 'DRIVER'];
        $key = array_rand($generate);
        return $generate[$key];
    }
}