<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id',
        'info_flag',
        'title',
        'image',
        'content',
    ];

    // the flag for info_flag
    const INFO_FLAG_DELETED = 0x99;
}
