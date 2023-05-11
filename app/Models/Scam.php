<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scam extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'content',
        'contact',
        'payment',
        'uploaded_id'
    ];

    protected $dates = [ 'deleted_at' ];
}
