<?php

namespace App\Tweet\Domain;

use App\Shared\Domain\Bus\Query\Response;

class TweetResponse implements Response
{
    public function __construct(public string $text)
    {
    }

    public static function getTextsFromTweets(array $tweets): array
    {
        return array_map(function ($tweet) {
            return $tweet->text;
        }, $tweets);
    }
}