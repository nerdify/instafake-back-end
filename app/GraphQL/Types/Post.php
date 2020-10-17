<?php

namespace App\GraphQL\Types;

use App\Domain\Likes\Models\Like;
use App\Domain\Posts\Models\Post as PostModel;
use App\Domain\Comments\Models\Comment;
use App\Domain\Users\Models\User;
use Nuwave\Lighthouse\Schema\Context;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post
{
    public function imageUrl(Media $media): string
    {
        return $media->getFullUrl();
    }

    public function rootComment(PostModel $post): Comment
    {
        return $post->comments()->where('is_root', true)->first();
    }

    public function viewerHasBookmarked(PostModel $post, array $args, Context $context): bool
    {
        /** @var User $user */
        $user = $context->user();

        if (! $user) {
            return false;
        }

        return $post->users->contains($user);
    }

    public function viewerHasLiked(PostModel $post, array $args, Context $context): bool
    {
        /** @var User $user */
        $user = $context->user();

        if (! $user) {
            return false;
        }

        return $post->likes->contains(fn(Like $like) => $like->user_id == $user->id);
    }
}
