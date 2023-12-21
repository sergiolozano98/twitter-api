<?php

namespace App\Tweet\Application\Find;

use App\Shared\Domain\Bus\Query\QueryHandler;

class FindTweetQueryHandler implements QueryHandler
{

    private $finder;

    public function __construct(TweetFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(FindTweetQuery $query): array
    {
        /*@TODO VO*/
        $username = $query->getUsername();
        $limit = $query->getLimit();


        return $this->finder->__invoke($username, $limit);
    }
}