<?php

namespace App\GraphQL\Mutations\Posts;

use App\Domain\Posts\Models\Post;
use App\Domain\Users\Models\User;
use Nuwave\Lighthouse\Schema\Context;

class CreatePost
{
    /**
     * @param null $_
     * @param array<string, mixed> $args
     * @param Context $context
     *
     * @return array
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function __invoke($_, array $args, Context $context): array
    {
        /** @var User $user */
        $user = $context->user();
        /** @var Post $post */
        $post = $user->posts()->create();

        $post->comments()->create(
            [
                'is_root' => true,
                'text' => $args['input']['text'],
                'user_id' => $context->user()->id,
            ]
        );

        foreach ($args['input']['photos'] as $photo) {
            $post->addMedia($photo)
                ->toMediaCollection(Post::POSTS_COLLECTION);
        }

        return compact('post');
    }
}
