<?php

namespace App\GraphQL\Types;

use App\Domain\Comments\Models\Comment as CommentModel;
use App\Domain\Likes\Models\Like;
use Nuwave\Lighthouse\Schema\Context;

class Comment
{
    public function viewerHasLiked(CommentModel $comment, array $args, Context $context): bool
    {
        /** @var User $user */
        $user = $context->user();

        if (! $user) {
            return false;
        }

        return $comment->likes->contains(fn(Like $like) => $like->user_id == $user->id);
    }
}
