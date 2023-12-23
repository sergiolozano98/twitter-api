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
     * @Route("/tweets/{userName}", methods={"GET"})
     *
     * @param Request $request
     * @param string $userName
     *
     * @return JsonResponse
     * @throws InvalidArgumentException
     */
    public function __invoke(Request $request, string $userName): JsonResponse
    {
        try {
            $limit = $request->get('limit');
            $cacheKey = 'tweets_' . $userName . '_' . ($limit ?? 'default_limit');

            $cachedItem = $this->tweetCache->getItem($cacheKey);

            if (!$cachedItem->isHit()) {
                $query = new FindTweetQuery($userName, (int)$limit);

                $result = $this->bus->ask($query);

                $cachedItem->set($result);
                $this->tweetCache->save($cachedItem);
            }

            $result = $cachedItem->get();

            return new JsonResponse($result);

        } catch (\Exception $exception) {
            return new JsonResponse(['status' => sprintf('Bad Request (%s)', $exception->getMessage())], Response::HTTP_BAD_REQUEST);
        }
    }
}
