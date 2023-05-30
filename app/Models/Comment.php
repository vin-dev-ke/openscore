<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'scam_id'
    ];

    public function scam ()
    {
        return $this->belongsTo(Scam::class);
    }
}
