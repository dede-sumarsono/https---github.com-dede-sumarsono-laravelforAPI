<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'post_id','user_id','comments_contents'
    ];

    /**
     * Get the comentator that owns the Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commentator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); //foreinkey user_id di tabel komen dan id di table id
    }
}
