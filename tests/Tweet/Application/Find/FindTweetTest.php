<?php

namespace App\Tests\Tweet\Application\Find;

use App\Tests\Tweet\Domain\TweetMother;
use App\Tweet\Application\Find\FindTweetQuery;
use App\Tweet\Application\Find\FindTweetQueryHandler;
use App\Tweet\Application\Find\TweetFinder;
use App\Tweet\Domain\LimitNotValidException;
use App\Tweet\Domain\TweetRepository;
use PHPUnit\Framework\TestCase;

/**
 * @group tweet
 */
class FindTweetTest extends TestCase
{
    private TweetRepository|null $repository = null;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(TweetRepository::class);

        $this->handler = new FindTweetQueryHandler(new TweetFinder($this->repository));
    }

    /**
     * @test
     * @throws LimitNotValidException
     */
    public function it_should_find_and_return_tweets_by_username_and_limit()
    {
        $query = new FindTweetQuery('username', 4);

        $tweets = [
            TweetMother::withSpecificText('foo'),
            TweetMother::withSpecificText('bar'),
        ];

        $this->repository
            ->expects($this->once())
            ->method('searchByUserName')
            ->willReturn($tweets);

        $response = $this->executeHandler($query);

        $this->assertEquals(['foo', 'bar'], $response);
    }

    /**
     * @test
     * @throws LimitNotValidException
     */
    public function it_should_find_and_return_empty_array_when_not_existing_username()
    {
        $query = new FindTweetQuery('username', 4);

        $tweets = [];

        $this->repository
            ->expects($this->once())
            ->method('searchByUserName')
            ->willReturn($tweets);

        $response = $this->executeHandler($query);

        $this->assertEquals([], $response);
    }

    /**
     * @test
     */
    public function it_should_return_exception_when_limit_is_major_than_10()
    {
        $this->expectException(LimitNotValidException::class);

        $query = new FindTweetQuery('username', 11);

        $this->repository
            ->expects($this->never())
            ->method('searchByUserName');

        $this->executeHandler($query);
    }

    /**
     * @throws LimitNotValidException
     */
    private function executeHandler(FindTweetQuery $query)
    {
        return ($this->handler)($query);
    }
}