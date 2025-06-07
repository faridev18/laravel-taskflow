<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    //
    protected $fillable = [
        "name",
        "owner_id",
        "color"
    ];

    public function boards() {
        return $this->hasMany(Board::class);
    }

    
}
