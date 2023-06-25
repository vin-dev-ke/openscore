<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'content',
        'scam_id',
        'user_id'
    ];

    protected $dates = ['deleted_at'];

    public function scam ()
    {
        return $this->belongsTo(Scam::class);
    }

    public function user () 
    {
        return $this->belongsTo(User::class);
    }
}
