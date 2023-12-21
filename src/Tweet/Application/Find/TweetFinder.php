<?php

namespace App\Tweet\Application\Find;

use App\Tweet\Domain\TweetFinder as TweetFinderDomain;
use App\Tweet\Domain\TweetLimit;
use App\Tweet\Domain\TweetRepository;
use App\Tweet\Domain\TweetUsername;

class TweetFinder
{
    /**
     * @var TweetFinderDomain
     */
    private $finder;

    public function __construct(TweetRepository $repository)
    {
        $this->finder = new TweetFinderDomain($repository);
    }

    public function __invoke(TweetUsername $username, TweetLimit $limit): array
    {
        return $this->finder->__invoke($username, $limit);
    }
}