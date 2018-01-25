<?php

namespace Collejo\Foundation\Menus;

/**
 * @file MenuItem.php
 * Description.
 *
 * @author Anuradha Jayathilaka <anuradha@collejo.com>
 * @copyright © 2017 CodeBreez, all rights reserved.
 * @version 1.0.0
 */

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Collection;
use Gate;

class MenuItem implements ArrayAccess, Arrayable{

	protected $name;

	protected $label;

	protected $icon;

	protected $path;

	protected $parent;

	protected $position = 'left';

	protected $permission;

	public $children;

	public $order;

	public $type;

	public function setType($type)
	{
		$this->type = $type;
		return $this;
	}

	public function setPermission($permission)
	{
		$this->permission = $permission;
		return $this;
	}

	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	public function setParent($name)
	{
		$this->parent = $name;
		return $this;
	}

	public function setPosition($position)
	{
		$this->position = $position;
		return $this;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setLabel($label)
	{
		$this->label = $label;
		return $this;
	}

	public function getLabel()
	{
		return $this->label;
	}

	public function setIcon($icon)
	{
		$this->icon = $icon;
		return $this;
	}

	public function getIcon()
	{
		return $this->icon;
	}

	public function setPath($routeName)
	{
		$router = app()->make('router');

		foreach($router->getRoutes() as $route){

			if ($route->getName() == $routeName){

				$this->path = $route->uri;
			}
		}
	}

	public function getPath()
	{
		return $this->path;
	}

	public function isVisible()
	{
		if ($this->children->count()) {

			foreach ($this->children as $child) {

				if ($child->permission && Gate::allows($child->permission)) {

					return true;
				}
			}
		} else {

			if ($this->permission && Gate::allows($this->permission)) {

				return true;
			}
		}

		return false;
	}

	public function getPermission()
	{
		return $this->permission;
	}

	public function getParent()
	{
		return $this->parent;
	}

	public function getPosition()
	{
		return $this->position;
	}

	public function getFullPath()
	{
		return '/' . ltrim($this->getPath(), '/');
	}

	public function setOrder($order)
	{
		$this->order = $order;
		return $this;
	}

	public function toArray()
	{
		return [
			'name' =>  $this->getName(),
			'label' =>  $this->getLabel(),
			'icon' =>  $this->getIcon(),
			'path' =>  $this->getPath(),
			'parent' =>  $this->getParent(),
			'position' => $this->getPosition(),
			'children' => $this->children->values()
		];
	}

	public function offsetExists($offset)
	{
		return property_exists($this, $offset);
	}

	public function offsetGet($offset)
	{
		return $this->$offset;
	}

	public function offsetSet($offset, $value)
	{
		$this->$offset = $value;
	}

	public function offsetUnset($offset)
	{
		$this->$offset = null;
	}

	public function __construct()
	{
		$this->children = new Collection;
	}
}