<?php

namespace App\GraphQL\Scalars;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Utils\Utils;

/**
 * Read more about scalars here http://webonyx.github.io/graphql-php/type-system/scalar-types/.
 */
class Email extends ScalarType
{
    /**
     * @var string
     */
    public $name = 'Email';

    /**
     * The description that is used for schema introspection.
     *
     * @var string
     */
    public $description = 'A [RFC 5321](https://tools.ietf.org/html/rfc5321) compliant email.';

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
            throw new Error(
                $this->invalidStringMessage($value)
            );
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
            throw new Error(
                $this->invalidStringMessage($valueNode->value),
                $valueNode
            );
        }

        return $valueNode->value;
    }

    /**
     * @param string $stringValue
     *
     * @return string
     */
    protected function invalidStringMessage(string $stringValue): string
    {
        $safeValue = Utils::printSafeJson($stringValue);

        return __('validation.email', ['attribute' => $safeValue]);
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    protected function isValid($value)
    {
        return (new EmailValidator())->isValid(
            $value,
            new RFCValidation()
        );
    }
}
