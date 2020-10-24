<?php

namespace App\GraphQL\Validators;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Validation\Validator;

class RemoveBookmarkInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'postId' => Rule::exists('posts', 'id'),
        ];
    }
}
