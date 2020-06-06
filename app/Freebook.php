<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Freebook extends Model
{
    protected $fillable=[
        'name','writer_name','description','image','available','category_id','user_id'
      ];
      const available_book='1';
      const unavailable_book='0';
      
      public function isAvailable(){
          return $this->available==Freebook::available_book;
      }
     
      public function categories(){
          return $this->belongsToMany(Category::class);
      }

      public function discussion(){
        return   $this->hasOne(Discussion::class);
        }
        
        public function user(){
            return $this->belongsTo(User::class);
        }
}
