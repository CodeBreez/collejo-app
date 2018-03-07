<?php

namespace Collejo\App\Models;

use Collejo\App\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = ['mime', 'bucket', 'ext'];

    public function url($size = null)
    {
        return '/media/'.$this->bucket.'/'.$this->id.(!is_null($size) ? '_'.$size : '').'.'.$this->ext;
    }

    public function getFileNameAttribute()
    {
        return $this->id.'.'.$this->ext;
    }
}
