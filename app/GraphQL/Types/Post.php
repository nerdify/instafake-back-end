<?php

namespace App\GraphQL\Types;

use App\Domain\Posts\Models\Post as PostModel;
use App\Domain\Users\Models\User;
use Nuwave\Lighthouse\Schema\Context;

class Post
{
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
