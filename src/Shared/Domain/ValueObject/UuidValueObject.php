<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidArgument;
use App\Shared\Domain\Utils\Uuid;
use http\Exception\InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class UuidValueObject extends ValueObject implements \Stringable
{
    final public function __construct(string $value)
    {
        parent::__construct($value);
        $this->ensureIsValidUuid($value);
    }

    final public static function generate()
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    final public function getValue(): string
    {
        return $this->value;
    }

    final public function equals(self $other): bool
    {
        return $this->getValue() === $other->getValue();
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    private function ensureIsValidUuid(string $id): void
    {
        if (!RamseyUuid::isValid($id)) {
            InvalidArgument::throw(sprintf('<%s> does not allow the value <%s>.', self::class, $id));
        }
    }
}
