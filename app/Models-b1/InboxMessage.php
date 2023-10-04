<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InboxMessage extends Model
{
    use HasFactory;

    protected $table = 'inbox_messages';
    
    public $timestamps = false;



    public function user()
    {
        return $this->belongsTo(User::class, 'receive_id');
    }
}
