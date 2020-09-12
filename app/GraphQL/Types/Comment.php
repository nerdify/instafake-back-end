<?php

namespace App\GraphQL\Types;

use App\Domain\Comments\Models\Comment as CommentModel;

class Comment
{
    public function viewerHasLiked(CommentModel $comment, array $args, Context $context): bool
    {
        /** @var User $user */
        $user = $context->user();

        if (! $user) {
            return false;
        }

        return $comment->likes()
            ->where('user_id', $user->id)
            ->exists();
    }
}
