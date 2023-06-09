<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'scam_id',
        'user_id'
    ];

    public function scam ()
    {
        return $this->belongsTo(Scam::class);
    }

    public function user () 
    {
        return $this->belongsTo(User::class);
    }
}
