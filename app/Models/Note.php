<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function registers()
    {
        return $this->belongsToMany(Register::class, 'registers');
    }

}
