<?php

namespace App\Domain\Posts\Models;

use App\Domain\Comments\Models\Comment;
use App\Domain\Users\Models\User;
use App\Domain\Likes\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    const POSTS_COLLECTION = 'posts';

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->where('is_root', false);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
