<?php

namespace App\Tweet\Application\Find;

use App\Tweet\Domain\TweetFinder as TweetFinderDomain;
use App\Tweet\Domain\TweetRepository;

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

    public function __invoke(string $username, int $limit): array
    {
        return $this->finder->__invoke($username, $limit);
    }
}