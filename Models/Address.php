<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Collejo\App\Models\User;

class Address extends Model
{

    protected $table = 'addresses';

    protected $fillable = ['full_name', 'user_id', 'address', 'city', 'postal_code', 'phone', 'created_by', 'updated_by', 'note', 'is_emergency'];

    protected $casts = ['is_emergency' => 'boolean'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
