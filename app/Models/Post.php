<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $id)
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'user_id'
    ];
}
