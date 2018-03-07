<?php

namespace Collejo\App\Foundation\Theme;

use ArrayAccess;
use Gate;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Collection;

class Menu implements ArrayAccess, Arrayable
{
    protected $name;

    protected $label;

    protected $icon;

    protected $path;

    protected $parent;

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

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
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

    public function getFullPath()
    {
        return '/'.ltrim($this->getPath(), '/');
    }

    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    public function toArray()
    {
        return [
            'name'   => $this->name,
            'label'  => $this->label,
            'icon'   => $this->icon,
            'path'   => $this->path,
            'parent' => $this->parent,
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
        $this->children = new Collection();
    }
}
