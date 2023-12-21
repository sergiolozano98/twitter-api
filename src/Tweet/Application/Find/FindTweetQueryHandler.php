<?php

namespace App\Tweet\Application\Find;

use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Tweet\Domain\LimitNotValidException;
use App\Tweet\Domain\TweetLimit;
use App\Tweet\Domain\TweetResponse;
use App\Tweet\Domain\TweetUsername;

class FindTweetQueryHandler implements QueryHandler
{

    private $finder;

    public function __construct(TweetFinder $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @throws LimitNotValidException
     */
    public function __invoke(FindTweetQuery $query): array
    {
        $username = new TweetUsername($query->getUsername());
        $limit = new TweetLimit($query->getLimit());

        $result = $this->finder->__invoke($username, $limit);

        return array_map(function ($tweet) {
            return $tweet->getText();
        }, $result);
    }
}