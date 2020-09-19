<?php

namespace App\GraphQL\Types;

use App\Domain\Posts\Models\Post as PostModel;
use App\Domain\Users\Models\User;
use Nuwave\Lighthouse\Schema\Context;

class Post
{
    public function viewerHasBookmarked(PostModel $post, array $args, Context $context): bool
    {
        /** @var User $user */
        $user = $context->user();

        if (! $user) {
            return false;
        }

        return $user->bookmarks()
            ->where('post_id', $post->id)
            ->exists();
    }

    public function viewerHasLiked(PostModel $post, array $args, Context $context): bool
    {
        /** @var User $user */
        $user = $context->user();

        if (! $user) {
            return false;
        }

        return $post->likes()
            ->where('user_id', $user->id)
            ->exists();
    }
}
