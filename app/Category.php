<?php

namespace mat3am;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //One To Many Relationship
    public function items(){
    	return $this->hasMany('mat3am\Item');
    }
}
