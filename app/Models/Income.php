<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $guarded = [];

    public function savings(){
        return $this->hasMany(Saving::class);
    }
}
