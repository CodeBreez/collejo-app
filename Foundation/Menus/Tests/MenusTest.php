<?php

namespace Collejo\Foundation\Menus\Tests;

use Collejo\Foundation\Tests\TestCase;
use Collejo\Foundation\Support\Facades\Menus;
use Illuminate\Support\Facades\Route;

class MenusTest extends TestCase
{

    public function testMenuGroup()
    {
        $group = $this->createMenuGroup();

        $this->assertTrue($group->getPosition() == 'right');
        $this->assertTrue($group->getLabel() == 'main');
        $this->assertTrue($group->getIcon() == 'icon');
    }

    public function testMenuItem()
    {
        $group = $this->createMenuGroup();

        $menu = $this->createMenuItem();

        $menu->setParent($group);

        $this->assertTrue($menu->getName() == 'name');
        $this->assertTrue($menu->getLabel() == 'sub');
        $this->assertTrue($menu->getPath() == 'test');
        $this->assertTrue($menu->getFullPath() == '/test');
    }

    public function createMenuGroup()
    {
        return Menus::group('main', 'icon', function ($parent) {

        })->setOrder(1)->setPosition('right');
    }

    public function createMenuItem()
    {
        Route::get('test', 'LoginController@showLoginForm')->name('test');

        return Menus::create('name', 'sub')->setPath('test');
    }
}