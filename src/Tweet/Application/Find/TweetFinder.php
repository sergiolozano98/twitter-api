<?php

namespace App\Tweet\Application\Find;

use App\Tweet\Domain\TweetLimit;
use App\Tweet\Domain\TweetRepository;
use App\Tweet\Domain\TweetUsername;

class TweetFinder
{
    public function __construct(private readonly TweetRepository $repository)
    {
    }

    public function __invoke(TweetUsername $username, TweetLimit $limit): array
    {
        return $this->repository->searchByUserName($username, $limit);
    }
}