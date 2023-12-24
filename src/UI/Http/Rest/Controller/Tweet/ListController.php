<?php

namespace App\UI\Http\Rest\Controller\Tweet;

use App\Shared\Domain\Bus\Query\QueryBus;
use App\Tweet\Application\Find\FindTweetQuery;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

final class ListController extends AbstractController
{
    public function __construct(private readonly QueryBus $bus, public CacheInterface $tweetCache)
    {
    }

    /**
     * @Route ("/tweets/{userName}", methods={"GET"})
     *
     * @param Request $request
     * @param string $userName
     * @return JsonResponse
     * @throws InvalidArgumentException
     */
    public function __invoke(Request $request, string $userName): JsonResponse
    {
        try {
            $limit = $request->get('limit');
            $cacheKey = sprintf('tweets_%s_%s', $userName, $limit);

            $result = $this->tweetCache->get($cacheKey, function () use ($userName, $limit) {
                return $this->bus->ask(new FindTweetQuery($userName, (int)$limit));
            });

            return new JsonResponse($result);

        } catch (\Exception $exception) {
            return new JsonResponse(['status' => sprintf('Bad Request (%s)', $exception->getMessage())], Response::HTTP_BAD_REQUEST);
        }
    }
}
