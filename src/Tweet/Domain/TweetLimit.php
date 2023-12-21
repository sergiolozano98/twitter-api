<?php

namespace App\Tweet\Domain;

class TweetLimit
{
    protected $limit;

    /**
     * @throws LimitNotValidException
     */
    public function __construct(int $limit)
    {
        $this->limit = $limit;
        $this->assertValueIsValid($limit);
    }

    public static function create(int $limit): TweetLimit
    {
        return new self($limit);
    }

    public function getValue(): int
    {
        return $this->limit;
    }

    /**
     * @throws LimitNotValidException
     */
    private function assertValueIsValid(int $limit): void
    {
        if ($limit <= 0 || $limit > 10) {
            throw new LimitNotValidException($limit);
        }
    }
}