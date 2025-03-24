<?php

namespace App\Modules\Shared\Model;

use Exception;
use ReflectionClass;

abstract class Enum
{
    /** @var ReflectionClass<Enum>[] */
    private static array $reflection_cache = [];

    public function __construct(protected string $value)
    {
        if (!static::isValid($value)) {
            throw $this->onErrorException();
        }
    }

    public static function isValid(string $value): bool
    {
        $reflection = self::$reflection_cache[static::class] ?? (self::$reflection_cache[static::class] = new ReflectionClass(static::class));
        return in_array($value, $reflection->getConstants());
    }

    public function is(string $value): bool
    {
        return $this->value === $value;
    }

    public function isNot(string $value): bool
    {
        return !$this->is($value);
    }

    abstract protected function onErrorException(): Exception;

    public function __toString(): string
    {
        return $this->value;
    }
}
