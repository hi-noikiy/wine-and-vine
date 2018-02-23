<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acidity extends Model
{
    public function grapes()
    {
        return $this->hasMany(Grape::class);
    }
}
