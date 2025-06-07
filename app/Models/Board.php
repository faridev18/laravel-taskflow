<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    //
    protected $fillable = [
        "name",
        "workspace_id",
    ];

    public function workspace()
    {
        return $this->belongTo(Workspace::class);
    }

}
