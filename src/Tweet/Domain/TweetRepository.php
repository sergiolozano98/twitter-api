<?php

namespace App\Tweet\Domain;

interface TweetRepository
{
    public function searchByUserName(string $username, int $limit): array;
}