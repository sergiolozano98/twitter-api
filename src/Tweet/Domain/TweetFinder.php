<?php

namespace App\Tweet\Domain;

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