<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paidbook extends Model
{
  protected $hidden=['pivot'];

    protected $fillable=[
        'name','writer_name','description','image','available','category_id','user_id','price','quantity'
      ];
        const available_book='1';
        const unavailable_book='0';

        public function isAvailable(){
            return $this->available==Paidbook::available_book;
        }

        public function transactions(){
          return $this->hasMany(Transaction::class);
        }
        public function categories(){
          return $this->belongsToMany(Category::class);
        }
        public function seller(){
          return $this->belongsTo(Seller::class);
        }
}
