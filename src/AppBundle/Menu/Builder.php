<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-04-03
 * Time: 12:34
 */

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('Main', ['route' => 'homepage']);

        return $menu;
    }


    public function driverMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('Main', ['route' => 'homepage']);
        $menu->addChild('Get Order', ['route' => 'car_list']);

        return $menu;
    }

    public function customerMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('Main', ['route' => 'homepage']);
        $menu->addChild('Get taxi', ['route' => 'car_list']);

        return $menu;
    }

    public function adminMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('Main', ['route' => 'homepage']);
        $menu->addChild('Car Management', ['route' => 'car_list']);
        $menu->addChild('Orders', ['route' => 'show_orders']);
        $menu->addChild('User Management', ['route' => 'all_users']);
        $menu->addChild('Order a car', ['route' => 'get_free_car']);
        $menu->addChild('Driver order lost', ['route' => 'get_free_car']);

        return $menu;
    }

    public function driverCustomerMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('Main', ['route' => 'homepage']);
        $menu->addChild('Free Cars', ['route' => 'car_list']);
        $menu->addChild('Get Order', ['route' => 'get_free_car']);


        return $menu;
    }
}