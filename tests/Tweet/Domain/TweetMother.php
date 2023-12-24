<?php

namespace App\Tests\Tweet\Domain;

use App\Tweet\Domain\Tweet;

class TweetMother
{
    public static function create(
        ?string    $text = null,
    ): Tweet
    {
        return new Tweet(
            $text ?? 'text',
        );
    }

    public static function withSpecificText(string $text): Tweet
    {
        return self::create($text);
    }
}