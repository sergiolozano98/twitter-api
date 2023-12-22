<?php

namespace App\Tweet\Domain;

final class Tweet
{
    public function __construct(public readonly string $text)
    {
    }
}
