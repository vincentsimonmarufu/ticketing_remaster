<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'contactable',
        'subject',
        'description',
        'resolved_status',
        'resolved_how',
        'resolved_by',
        'category',
        'key'
    ];

    public function ticketCategory(){
        return $this->hasOne(TicketCategory::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
