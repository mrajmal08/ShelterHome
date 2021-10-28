<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddShelterRequest extends Model
{
    protected $table='shelter_request';

    public function user_facility()
    {
    	return $this->hasOne('App\ApproveShelter','user_id','id');
    }

    public function user_facilities()
    {
    	return $this->hasOne('App\UserFacilitiies','user_id','id');
    }

}
