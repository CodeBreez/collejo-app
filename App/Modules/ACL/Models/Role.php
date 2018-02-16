<?php

namespace Collejo\App\Modules\ACL\Models;

use Collejo\Foundation\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $table = 'roles';

    protected $fillable = ['role'];

    /**
     * Get a proper name that could be rendered in the front end.
     *
     * @return mixed
     */
    public function getNameAttribute()
    {
        return str_replace('_', ' ', ucfirst($this->role));
    }

    /**
     * Returns a collection of Users for this Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Returns a collection of Permissions for this Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
