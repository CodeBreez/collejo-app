<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Collejo\App\Models\User;

class Address extends Model
{

    protected $table = 'addresses';

    protected $fillable = ['address_type', 'user_id', 'address', 'city', 'postal_code', 'created_by', 'updated_by', 'note'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
