<?php

namespace App\Modules\Shared\Model;

use Exception;
use Ramsey\Uuid\Uuid;

trait ContructableUuidTrait
{
    public function __construct(private string $uuid)
    {
        if (!Uuid::isValid($uuid)) {
            throw new Exception('Invalid UUID', 1000);
        }
    }

    public function __toString(): string
    {
        return $this->uuid;
    }
}
