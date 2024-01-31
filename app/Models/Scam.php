<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scam extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'contact',
        'payment',
        'scammer_name',
        'amount',
        'scam_activity',
        'platform',
        'description',
        'country',
        'file_id',
        'user_id'
    ];

    protected $dates = ['deleted_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function file(): HasOne
    {
        return $this->hasOne(File::class);
    } 

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
