<?php

namespace Collejo\App\Modules\ACL\Models;

use Collejo\Foundation\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = ['full_name', 'user_id', 'address', 'city', 'postal_code', 'phone', 'note', 'is_emergency'];

    protected $casts = ['is_emergency' => 'boolean'];

    /**
     * Returns the User of this Address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
