<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidArgument;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Stringable;

class Uuid implements Stringable
{
    protected function __construct(protected string $value)
    {
        /*
          This class is trusted,
          to improve performance do not validate when using a protected constructor.
        */
    }

    public static final function fromString(string $value): self
    {
        // value is not trusted, so validate here
        $uuid = new static($value);
        static::ensureIsValidUuid($uuid->value);
        return $uuid;
    }

    public static function generate(): self
    {
        // RamseyUuid::uuid4 is a valid Uuid, so call constructor without validation
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
