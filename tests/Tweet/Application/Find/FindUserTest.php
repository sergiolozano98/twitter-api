<?php

namespace App\Tests\Tweet\Application\Find;

use App\Tweet\Application\Find\FindTweetQuery;
use App\Tweet\Application\Find\FindTweetQueryHandler;
use App\Tweet\Application\Find\TweetFinder;
use App\Tweet\Domain\LimitNotValidException;
use App\Tweet\Domain\TweetRepository;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

/**
 * @group user
 */
class FindUserTest extends TestCase
{
    /**
     * @var ?TweetRepository
     */
    private $repository = null;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->repository = $this->createMock(TweetRepository::class);

        $this->handler = new FindTweetQueryHandler(new TweetFinder($this->repository));
    }

    /**
     * @test
     * @throws LimitNotValidException
     */
    public function it_should_find_and_return_existing_user()
    {
        $query = new FindTweetQuery('username', 4);

        $tweets = ['hola', 'adios'];

        dd($tweets);

        $this->repository
            ->expects($this->once())
            ->method('searchByUserName')
            ->willReturnMap($tweets);

        $response = $this->executeHandler($query);

        dd($response);

        /*$this->assertEquals([], $response);*/
    }

    /**
     * @test
     */
    public function it_should_find_and_return_null_when_not_existing_user()
    {
        /*        $this->expectException(UserNotFoundException::class);

                $uuid = Uuid::random();
                $query = new FindUserQuery($uuid);

                $this->repository
                    ->expects($this->once())
                    ->method('search')
                    ->willReturn(null);

                $this->executeHandler($query);*/
    }

    /**
     * @throws LimitNotValidException
     */
    private function executeHandler(FindTweetQuery $query)
    {
        return ($this->handler)($query);
    }
}