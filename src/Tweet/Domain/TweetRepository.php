<?php

namespace App\Tweet\Domain;

interface TweetRepository
{
    public function searchByUserName(TweetUsername $username, TweetLimit $limit): array;
}