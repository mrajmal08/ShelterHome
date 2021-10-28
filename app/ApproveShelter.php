<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApproveShelter extends Model
{
    protected $table='approve_shelter';


    public function room()
    {
    	return $this->hasOne('App\AddRoom','id','room_id');
    }
}
