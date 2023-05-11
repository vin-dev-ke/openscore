<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path'
    ];
<<<<<<< HEAD

    public function scam()
    {
        return $this->belongsTo(Scam::class);
    }
=======
>>>>>>> 4494bb2 (Add users and scams sections for admin)
}
