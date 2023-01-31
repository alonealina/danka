<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSendList extends Model
{
    use HasFactory;

    protected $guarded = ['id']; 
    protected $table = 'event_send_list';
}
