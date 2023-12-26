<?php

namespace App\Tweet\Domain;

final readonly class Tweet
{
    public function __construct(public string $text)
    {
    }
}
