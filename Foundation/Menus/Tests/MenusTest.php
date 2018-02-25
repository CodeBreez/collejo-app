<?php

namespace Collejo\Foundation\Menus\Tests;

use Collejo\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Route;
use Menu;

class MenusTest extends TestCase
{
    /**
     * Test menu group.
     */
    public function testMenuGroup()
    {
        $group = $this->createMenuGroup();

        $this->assertTrue($group->getPosition() == 'right');
        $this->assertTrue($group->getLabel() == 'main');
        $this->assertTrue($group->getIcon() == 'icon');
    }

    /**
     * Test menu item.
     */
    public function testMenuItem()
    {
        $group = $this->createMenuGroup();

        $permission = 'some_permission';
        $icon = 'some_icon';
        $order = 12;

        $menu = $this->createMenuItem();

        $menu->setParent($group)
            ->setPermission($permission)
            ->setIcon($icon)
            ->setOrder($order);

        $this->assertTrue($menu->getParent() == $group);
        $this->assertTrue($menu->getName() == 'name');
        $this->assertTrue($menu->getLabel() == 'sub');
        $this->assertTrue($menu->getPath() == 'test');
        $this->assertTrue($menu->getFullPath() == '/test');
        $this->assertTrue($menu->type == 'm');
        $this->assertTrue($menu->getPermission() == $permission);
        $this->assertTrue($menu->getIcon() == $icon);
        $this->assertTrue($menu->order == $order);
        $this->assertFalse($menu->isVisible());
    }

    /**
     * Create new menu group.
     *
     * @return mixed
     */
    public function createMenuGroup()
    {
        return Menu::group('main', 'icon', function ($parent) {
        })->setOrder(1)->setPosition('right');
    }

    /**
     * Create a new menu item.
     *
     * @return mixed
     */
    public function createMenuItem()
    {
        Route::get('test', 'LoginController@showLoginForm')->name('test');

        return Menu::create('name', 'sub')->setPath('test');
    }
}
