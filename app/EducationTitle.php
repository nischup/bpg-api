<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationTitle extends Model
{
    
    public function category()
    {
    	return $this->belongsTo('App\EducationCategory', 'category_id');
    }

}
