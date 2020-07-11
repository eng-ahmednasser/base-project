<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'dateline', 'created_by', 'assigned_to', 'status',
    ];
    const STATUSIDS = [
        '1', '2', '3',
    ];
    const STATUS = [
        '1' => 'open',
        '2' => 'inprogress',
        '3' => 'closed',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    public function comments()
    {
        return $this->hasMany(TicketComment::class, 'ticket_id');
    }
}
