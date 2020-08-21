<?php

namespace App\GraphQL\Scalars;

use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Utils\Utils;
use Illuminate\Contracts\Validation\Validator;

/**
 * Read more about scalars here http://webonyx.github.io/graphql-php/type-system/scalar-types/.
 */
class Uri extends ScalarType
{
    /**
     * Serializes an internal value to include in a response.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function serialize($value)
    {
        return $value;
    }

    /**
     * Parses an externally provided value (query variable) to use as an input.
     *
     * @param mixed $value
     *
     * @return mixed
     * @throws Error
     */
    public function parseValue($value)
    {
        if (! $this->isValid($value)) {
            throw new Error('Cannot represent following value as uri: '.Utils::printSafeJson($value));
        }

        return $value;
    }

    /**
     * Parses an externally provided literal value (hardcoded in GraphQL query) to use as an input.
     *
     * E.g.
     * {
     *   user(email: "user@example.com")
     * }
     *
     * @param \GraphQL\Language\AST\Node $valueNode
     * @param mixed[]|null $variables
     *
     * @return mixed
     * @throws Error
     */
    public function parseLiteral($valueNode, ?array $variables = null)
    {
        if (! $valueNode instanceof StringValueNode) {
            throw new Error('Query error: Can only parse strings got: '.$valueNode->kind, $valueNode);
        }

        if (! $this->isValid($valueNode->value)) {
            throw new Error('Not a valid uri', $valueNode);
        }

        return $valueNode->value;
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    protected function isValid($value)
    {
        $validator = validator(['url' => $value], ['url' => ['required', 'url']]);

        return ! $validator->fails();
    }
}
