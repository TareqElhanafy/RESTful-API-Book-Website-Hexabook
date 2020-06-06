<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $hidden=['pivot'];

    protected $fillable=[
        'name','available','description'
      ];
  const Available_Category='1';
  const UNAvailable_Category='0';
  
  public function isAvailable(){
    return $this->available == Category::Available_Category;
}

public function paidbooks(){
  return $this->belongsToMany(Paidbook::class);
}
public function freebooks(){
  return $this->belongsToMany(Freebook::class);
}
}
