<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winery extends Model
{

    /**
     * Fetch Winery's address
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function address()
    {
        return $this->morphTo('addressable');
    }
}
