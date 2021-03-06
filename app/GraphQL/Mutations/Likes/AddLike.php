<?php

namespace App\GraphQL\Mutations\Likes;

use App\Domain\Comments\Models\Comment;
use App\Domain\Posts\Models\Post;
use GraphQL\Error\UserError;
use Illuminate\Database\Eloquent\Model;
use Nuwave\Lighthouse\Execution\Utils\Subscription;
use Nuwave\Lighthouse\Schema\Context;

class AddLike extends BaseLike
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

        $like = $model->likes()->create(
            [
                'user_id' => $context->user()->id,
            ]
        );

        $this->sendSubscription($model);

        return [
            'like' => $like,
            'subject' => $model,
        ];
    }


}
