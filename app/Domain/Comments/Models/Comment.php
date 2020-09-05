<?php

namespace App\Domain\Comments\Models;

use App\Domain\Posts\Models\Post;
use App\Domain\Users\Models\User;
use App\Domain\Likes\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
