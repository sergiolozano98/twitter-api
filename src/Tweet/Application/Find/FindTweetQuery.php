<?php

namespace App\Tweet\Application\Find;

use App\Shared\Domain\Bus\Query\Query;

class FindTweetQuery implements Query
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var int
     */
    private $limit;

    public function __construct(string $username, int $limit)
    {
        $this->username = $username;
        $this->limit = $limit;
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