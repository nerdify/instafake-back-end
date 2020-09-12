<?php

namespace App\GraphQL\Mutations\Comments;

use App\Domain\Comments\Models\Comment;
use Nuwave\Lighthouse\Pagination\Cursor;
use Nuwave\Lighthouse\Schema\Context;

class CreateComment
{
    public function __invoke($root, array $args, Context $context)
    {
        $comment = Comment::create(
            [
                'post_id' => $args['postId'],
                'text' => $args['text'],
                'user_id' => $context->user()->id,
            ]
        );

        return [
            'parent' => null,
            'commentEdge' => [
                'cursor' => Cursor::encode(Comment::count()),
                'node' => $comment,
            ],
        ];
    }
}
