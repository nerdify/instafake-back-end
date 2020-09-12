<?php

namespace App\GraphQL\Directives;

use Illuminate\Contracts\Auth\Access\Gate;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;
use Nuwave\Lighthouse\Schema\Directives\CanDirective as BaseCanDirective;

class CanDirective extends BaseCanDirective
{
    protected function authorize(Gate $gate, $ability, $model, array $arguments): void
    {
        // The signature of the second argument `$arguments` of `Gate::check`
        // should be [modelClassName, additionalArg, additionalArg...]
        array_unshift($arguments, $model);

        $response = $gate->inspect($ability, $arguments);

        if (! $response->allowed()) {
            throw new AuthorizationException(
                $response->message() ?? "You are not authorized to access {$this->nodeName()}"
            );
        }
    }
}
