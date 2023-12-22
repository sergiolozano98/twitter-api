<?php

namespace App\UI\Http\Rest\Controller\Tweet;

use App\Shared\Domain\Bus\Query\QueryBus;
use App\Tweet\Application\Find\FindTweetQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ListController extends AbstractController
{
    public function __construct(private readonly QueryBus $bus)
    {
    }

    /**
     * @Route("/tweets/{userName}", methods={"GET"})
     *
     * @param Request $request
     * @param string $userName
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, string $userName): JsonResponse
    {
        try {
            $query = new FindTweetQuery($userName, (int)$request->get('limit'));

            $result = $this->bus->ask($query);

            return new JsonResponse($result);
        } catch (\Exception $exception) {
            return new JsonResponse(['status' => sprintf('Bad Request (%s)', $exception->getMessage())], Response::HTTP_BAD_REQUEST);
        }
    }
}
