<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paper extends Model
{
    use softDeletes;

    /*protected $fillable = [
        'title',
        'original_text',
        'translated_text'
    ];*/

    use HasFactory;
}
