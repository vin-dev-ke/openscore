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
        'uploaded_id',
        'user_id'
    ];

    protected $dates = [ 'deleted_at' ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function file ()
    {
        return $this->hasOne(File::class);
    }

    public function comments ()
    {
        return $this->hasMany(Comment::class);
    }
}
