<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collejo\App\Models\User;

class Student extends Model
{
    
    use SoftDeletes;

    protected $table = 'students';

    protected $fillable = ['user_id', 'admission_number', 'admitted_on'];

    protected $dates = ['admitted_on'];

    public function class()
    {
        return $this->belongsTo(Clasis::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function getNameAttribute()
    {
    	return $this->user->name;
    }    

    public function getFirstNameAttribute()
    {
    	return $this->user->first_name;
    }    

    public function getLastNameAttribute()
    {
    	return $this->user->last_name;
    }   

    public function getDateOfBirthAttribute()
    {
        return $this->user->date_of_birth;
    }    

    public function getEmailAttribute()
    {
    	return $this->user->email;
    }

    public function getAddressesAttribute()
    {
        return $this->user->addresses;
    }
}


