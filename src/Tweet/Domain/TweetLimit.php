<?php

namespace App\Tweet\Domain;

readonly class TweetLimit
{
    /**
     * @throws LimitNotValidException
     */
    public function __construct(protected int $limit)
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