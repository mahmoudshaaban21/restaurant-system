<?php

namespace mat3am;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //Many To One Relationship
    public function category(){
    	return $this->belongsTo('mat3am\Category');
    }
}
