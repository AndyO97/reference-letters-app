<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'email',
        'subject',
        'body',
        'token',
        'completed',
    ];

    public function referenceLetter()
    {
        return $this->hasOne(ReferenceLetter::class);
    }
}
