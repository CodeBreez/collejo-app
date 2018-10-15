<?php

namespace Collejo\App\Modules\ACL\Models;

use Collejo\Foundation\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $fillable = ['permission', 'module'];

    protected $appends = ['name'];

    /**
     * Returns the Roles for this Permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Returns the child Permissions of this Permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    /**
     * Returns the parent Permission of this Permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    /**
     * Returns Permissions name.
     *
     * @return mixed
     */
    public function getNameAttribute()
    {
        return str_replace('_', ' ', ucfirst($this->permission));
    }
}
