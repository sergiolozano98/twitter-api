<?php

namespace App\Tests\Tweet\Domain;

use App\Tweet\Domain\TweetUsername;

class TweetUsernameMother
{
    public static function create(?string $username = null): TweetUsername
    {
        return TweetUsername::create($username ?? self::random());
    }

    private static function random(): string
    {
        return self::generateRandomString();
    }

    private static function generateRandomString(): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';

        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}