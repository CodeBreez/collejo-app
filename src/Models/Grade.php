<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Collejo\App\Models\Clasis;

class Grade extends Model
{

    protected $table = 'grades';

    protected $fillable = ['name'];

    public function classes()
    {
    	return $this->hasMany(Clasis::class);
    }
}
