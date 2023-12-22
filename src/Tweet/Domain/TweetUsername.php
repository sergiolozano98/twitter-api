<?php

namespace App\Tweet\Domain;

class TweetUsername
{
    public function __construct(protected readonly string $username)
    {
    }

    public static function create(string $username): TweetUsername
    {
        return new self($username);
    }

    public function getValue(): string
    {
        return $this->username;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}