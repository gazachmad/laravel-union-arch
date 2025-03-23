<?php

namespace App\Modules\Shared\Model;

use Ramsey\Uuid\Uuid;

trait GeneratableUuidTrait
{
    public function __construct(private string $uuid) {}

    public function __toString(): string
    {
        return $this->uuid;
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid4()->toString());
    }
}
