<?php

namespace App\Fountains\Application\Find\Filter;

class FindFountainByFilter
{
    private const DEFAULT_LIMIT = 100;
    private const DEFAULT_OFFSET = 0;

    public function __construct(
        private ?string $title = null,
        private ?string $provider_id =  null,
        private ?int $limit = null,
        private ?int $offset = null
    ) {
        $this->limit = $limit ?? self::DEFAULT_LIMIT;
        $this->offset = $offset ??  self::DEFAULT_OFFSET;
    }

    public function title(): ?string
    {
        return $this->title;
    }

    public function provider_id(): ?int
    {
        return $this->provider_id;
    }

    public function limit(): int
    {
        return $this->limit;
    }

    public function offset(): int
    {
        return $this->offset;
    }
}
