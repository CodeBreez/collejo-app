<?php

namespace Collejo\App\Modules\Media\Models;

use Collejo\Foundation\Database\Eloquent\Model;

class Media extends Model
{

    protected $table = 'media';

    protected $fillable = ['mime', 'bucket', 'ext'];

    protected $appends = ['small_url'];

    /**
     * Url for the file
     *
     * @param null $size
     * @return string
     */
    public function url($size = null)
    {
    	return '/media/' . $this->bucket . '/' . $this->id . (!is_null($size) ? '_' . $size : '')  . '.' . $this->ext;
    }

    /**
     * For images get the small version url
     *
     * @return string
     */
    public function getSmallUrlAttribute()
    {
        return $this->url('small');
    }

    /**
     * Get the filename with extension
     *
     * @return string
     */
    public function getFileNameAttribute()
    {
    	return $this->id . '.' . $this->ext;
    }
}
