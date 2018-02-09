<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wine extends Model
{
    public function onWishList() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}