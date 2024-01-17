<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $primaryKey = 'phone_id';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_user_id', 'user_id');
    }
}
