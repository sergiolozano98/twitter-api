<?php

namespace App\Tweet\Application\Find;

use App\Shared\Domain\Bus\Query\Query;

readonly class FindTweetQuery implements Query
{
    public function __construct(protected string $username, protected int $limit)
    {
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}