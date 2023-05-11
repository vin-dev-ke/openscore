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
<<<<<<< HEAD
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
=======
        'uploaded_id'
    ];

    protected $dates = [ 'deleted_at' ];
>>>>>>> 4494bb2 (Add users and scams sections for admin)
}
