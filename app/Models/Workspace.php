<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    //
    protected $fillable = [
        "name",
        "owner_id",
        "color",
    ];

    public function boards()
    {
        return $this->hasMany(Board::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "user_workspace")
            ->withPivot('role')
            ->withTimestamps();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

}
