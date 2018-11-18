<?php

namespace Collejo\App\Modules\Media\Models;

use Collejo\Foundation\Database\Eloquent\Model;

class Media extends Model
{

    protected $table = 'media';

    protected $fillable = ['mime', 'bucket', 'ext'];

    protected $appends = ['small_url'];

    public function url($size = null)
    {
    	return '/media/' . $this->bucket . '/' . $this->id . (!is_null($size) ? '_' . $size : '')  . '.' . $this->ext;
    }

    public function getSmallUrlAttribute()
    {
        return $this->url('small');
    }

    public function getFileNameAttribute()
    {
    	return $this->id . '.' . $this->ext;
    }
}
