<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collejo\App\Models\User;

class Student extends Model
{
    
    use SoftDeletes;

    protected $fillable = ['user_id', 'enrolled_on', 'enrolled_by'];

    protected $dates = ['enrolled_on'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
