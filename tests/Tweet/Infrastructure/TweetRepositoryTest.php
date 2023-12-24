<?php

namespace App\Tests\Tweet\Infrastructure;

use App\Tests\Tweet\Domain\TweetLimitMother;
use App\Tests\Tweet\Domain\TweetUsernameMother;
use App\Tweet\Domain\LimitNotValidException;
use App\Tweet\Domain\TweetRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @group tweet
 */
class TweetRepositoryTest extends KernelTestCase
{
    protected object $repository;

    protected function setUp(): void
    {
        self::bootKernel([
            'environment' => 'test',
        ]);

        $this->repository = $this->getContainer()->get(TweetRepository::class);
    }

    /**
     * @return void
     * @throws LimitNotValidException
     * @test
     */
    public function it_should_find_and_return_null_username_not_exist()
    {
        $result = $this->repository->searchByUserName(TweetUsernameMother::create(), TweetLimitMother::create(4));

        $this->assertNull($result);
    }

    /**
     * @throws LimitNotValidException
     * @test
     */
    public function it_should_find_and_return_tweet_when_username_exist(): void
    {
        $result = $this->repository->searchByUserName(TweetUsernameMother::create('jackDorsey'), TweetLimitMother::create(4));

        $this->assertCount(4, $result);
    }
}