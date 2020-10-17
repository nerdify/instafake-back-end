<?php

namespace App\GraphQL\Mutations\Likes;

use App\Domain\Comments\Models\Comment;
use App\Domain\Posts\Models\Post;
use GraphQL\Error\UserError;
use Nuwave\Lighthouse\Schema\Context;

class RemoveLike extends BaseLike
{
    public function __invoke($root, array $args, Context $context)
    {
        /** @var Comment|Post $model */
        $model = $this->getModel(...$args['subjectId']);

        throw_unless(
            $model,
            UserError::class,
            'The given subjectId does not exists.'
        );

        $model->likes()->delete();

        $this->sendSubscription($model);

        return [
            'subject' => $model,
        ];
    }
}
