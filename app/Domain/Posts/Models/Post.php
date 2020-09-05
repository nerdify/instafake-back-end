<?php

namespace App\Domain\Posts\Models;

use App\Domain\Comments\Models\Comment;
use App\Domain\Users\Models\User;
use App\Domain\Likes\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
