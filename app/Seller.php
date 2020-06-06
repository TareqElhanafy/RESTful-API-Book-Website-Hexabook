<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends User
{
    public function paidbooks(){
        return $this->hasMany(Paidbook::class);
    }
}
