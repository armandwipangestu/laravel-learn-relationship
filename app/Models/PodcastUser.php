<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PodcastUser extends Model
{
    use HasFactory;

    protected $table = 'podcast_user';
    protected $guarded = ['id'];
}
