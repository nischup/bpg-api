<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PipDetail extends Model
{
    public function pips()
    {
    	return $this->belongsTo('App\Pips', 'pips_id');
    }  

    public function signal()
    {
    	return $this->belongsTo('App\Signal', 'signal_id');
    }
}
