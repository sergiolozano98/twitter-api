<?php

namespace App\Tweet\Domain;

class TweetFinder
{
    /**
     * @var TweetRepository
     */
    private $repository;

    public function __construct(TweetRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $username, int $limit): array
    {
        return $this->repository->searchByUserName($username, $limit);
    }
}