<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidArgument;
use App\Shared\Domain\Utils\Uuid;
use http\Exception\InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class UuidValueObject extends Uuid implements \Stringable { }
