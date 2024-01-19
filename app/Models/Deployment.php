<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deployment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function environment(): BelongsTo
    {
        return $this->belongsTo(Environment::class, 'environment_id', 'id');
    }
}
