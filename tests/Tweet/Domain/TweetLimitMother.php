<?php

namespace App\Tests\Tweet\Domain;

use App\Tweet\Domain\LimitNotValidException;
use App\Tweet\Domain\TweetLimit;

class TweetLimitMother
{
    /**
     * @throws LimitNotValidException
     */
    public static function create(?int $limit = null): TweetLimit
    {
        return new TweetLimit($limit ?? self::random());
    }

    private static function random(): string
    {
        return rand(1, 10);
    }
}