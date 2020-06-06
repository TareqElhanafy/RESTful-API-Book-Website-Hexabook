<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable=[
        'paidbook_id','buyer_id','quantity'
    ];

    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }
    public function paidbook(){
        return $this->belongsTo(Paidbook::class);
    }
}
