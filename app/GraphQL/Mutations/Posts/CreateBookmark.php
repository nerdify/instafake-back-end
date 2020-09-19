<?php

namespace App\GraphQL\Mutations\Posts;

use App\Domain\Posts\Models\Post;
use App\Domain\Users\Models\User;
use Nuwave\Lighthouse\Pagination\Cursor;
use Nuwave\Lighthouse\Schema\Context;

class CreateBookmark
{
    public function __invoke($root, array $args, Context $context): array
    {
        /** @var User $user */
        $user = $context->user();
        $post = Post::find($args['postId']);

        $user->bookmarks()->attach($post->id);

        return [
            'post' => $post,
        ];
    }
}
