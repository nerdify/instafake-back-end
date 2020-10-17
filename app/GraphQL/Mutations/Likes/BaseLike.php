<?php

namespace App\GraphQL\Mutations\Likes;

use App\Domain\Comments\Models\Comment;
use App\Domain\Posts\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Nuwave\Lighthouse\Execution\Utils\Subscription;

class BaseLike
{
    protected function getModel(string $type, string $id): ?Model
    {
        $class = [
                'Comment' => Comment::class,
                'Post' => Post::class,
            ][$type] ?? null;

        if (! $class) {
            return null;
        }

        return $class::find(trim($id));
    }

    protected function sendSubscription(Model $model)
    {
        if (class_basename($model) == 'Post') {
            Subscription::broadcast('postUpdated', $model);
        }
    }
}
