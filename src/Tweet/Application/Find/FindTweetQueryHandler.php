<?php

namespace App\Tweet\Application\Find;

use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Tweet\Domain\LimitNotValidException;
use App\Tweet\Domain\TweetLimit;
use App\Tweet\Domain\TweetResponse;
use App\Tweet\Domain\TweetUsername;

class FindTweetQueryHandler implements QueryHandler
{
    public function __construct(private readonly TweetFinder $finder)
    {
    }

    /**
     * @throws LimitNotValidException
     */
    public function __invoke(FindTweetQuery $query): array
    {
        $username = new TweetUsername($query->getUsername());
        $limit = new TweetLimit($query->getLimit());

        $tweets = $this->finder->__invoke($username, $limit);

        return TweetResponse::getTextsFromTweets($tweets);
    }
}