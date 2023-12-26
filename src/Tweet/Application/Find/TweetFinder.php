<?php

namespace App\Tweet\Application\Find;

use App\Tweet\Domain\TweetLimit;
use App\Tweet\Domain\TweetRepository;
use App\Tweet\Domain\TweetUsername;
use App\Tweet\Domain\UserNameNotFoundException;

readonly class TweetFinder
{
    public function __construct(private TweetRepository $repository)
    {
    }

    /**
     * @throws UserNameNotFoundException
     */
    public function __invoke(TweetUsername $username, TweetLimit $limit): array
    {
        $tweets = $this->repository->searchByUserName($username, $limit);

        if (null === $tweets) {
            throw new UserNameNotFoundException($username);
        }

        return $tweets;
    }
}