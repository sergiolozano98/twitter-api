<?php

namespace App\Tweet\Domain;

class TweetLimit
{
    /**
     * @throws LimitNotValidException
     */
    public function __construct(protected readonly int $limit)
    {
        $this->assertValueIsValid($limit);
    }

    /**
     * @throws LimitNotValidException
     */
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