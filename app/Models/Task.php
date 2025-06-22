<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //

    protected $fillable = [
        'board_id',
        'user_id',
        'title',
        'description',
        'deadline',
        'state',
        'assigned_to',
    ];

    public function board() {
        return $this->belongsTo(Board::class);
    }

    public function assignedUser() {
        return $this->belongsTo(User::class, 'assigned_to');
    }


}
