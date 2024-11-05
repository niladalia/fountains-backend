<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Utils\Uuid;

class UuidValueObject extends Uuid implements \Stringable { }
