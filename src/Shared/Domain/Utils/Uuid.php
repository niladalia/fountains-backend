<?php

declare(strict_types=1);

namespace App\Shared\Domain\Utils;

use App\Shared\Domain\Exceptions\InvalidArgument;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Stringable;

class Uuid implements Stringable
{
    public function __construct(protected string $value)
    {
        $this->ensureIsValidUuid($value);
    }

    final public static function fromString(string $value): static
    {
        $uuid = new static($value);
        static::ensureIsValidUuid($uuid->value);
        return $uuid;
    }

    public static function generate(): static
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->getValue() === $other->getValue();
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    protected static function ensureIsValidUuid(string $id): void
    {
        if (!RamseyUuid::isValid($id)) {
            InvalidArgument::throw('Uuid format is not valid!');
        }
    }
}
