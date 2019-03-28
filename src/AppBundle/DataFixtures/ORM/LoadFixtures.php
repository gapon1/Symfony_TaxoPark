<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-03-28
 * Time: 18:32
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 2; $i++) {
            $product = new Car();
            $product->setName('product '.$i);
            $product->setCarDiscript("Desc");
            $product->setCarImg("BMW-2.png");
            $product->setCarType("hachback");
            $product->setDriverId(rand(1,10));
            $manager->persist($product);
        }

        $manager->flush();
    }

}