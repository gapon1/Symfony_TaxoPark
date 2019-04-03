<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-04-03
 * Time: 12:34
 */

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', ['route' => 'homepages']);
        // ... add more children

        return $menu;


    }


    public function createAdminMenu()
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', ['route' => 'admin']);
        // ... add more children

        return $menu;
    }


}