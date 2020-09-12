<?php

namespace App\Domain\Likes\Policies;

use App\Domain\Comments\Models\Comment;
use App\Domain\Likes\Models\Like;
use App\Domain\Posts\Models\Post;
use App\Domain\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LikePolicy
{
    use HandlesAuthorization;

    public function create(User $user, $injectArgs)
    {
        $class = [
            'Comment' => Comment::class,
            'Post' => Post::class,
        ][$injectArgs['subjectId'][0]] ?? null;

        if (! $class) {
            return false;
        }

        /** @var Comment|Post $model */
        $model = $class::find(trim($injectArgs['subjectId'][1]));

        if (! $model) {
            return false;
        }

        return $model->likes()
            ->where('user_id', $user->id)
            ->doesntExist();
    }
}
