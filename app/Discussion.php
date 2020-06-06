<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable=[
        'title','content','freebook_id'
      ];
      public function freebook(){
        return   $this->belongsTo(Freebook::class);
        }
}
