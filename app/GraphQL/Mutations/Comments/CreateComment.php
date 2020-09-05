<?php

namespace App\GraphQL\Mutations\Comments;

use App\Domain\Comments\Models\Comment;

class CreateComment
{
    public function __invoke($root, array $args)
    {
        $comment = Comment::create(
            [
                'post_id' => $args['postId'],
                'text' => $args['text'],
                'user_id' => $args['userId'],
            ]
        );

        return compact('comment');
    }
}
