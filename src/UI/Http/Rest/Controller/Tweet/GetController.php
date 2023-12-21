<?php

namespace App\UI\Http\Rest\Controller\Tweet;

use App\Tweet\Application\Find\FindTweetQuery;
use App\Tweet\Application\Find\FindTweetQueryHandler;
use App\Tweet\Domain\LimitNotValidException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as Route;

final class GetController extends AbstractController
{
    private $handler;

    public function __construct(FindTweetQueryHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @Route("/tweets/{userName}", methods={"GET"})
     *
     * @param Request $request
     * @param string $userName
     *
     * @return JsonResponse
     * @throws LimitNotValidException
     */
    public function __invoke(Request $request, string $userName): JsonResponse
    {
        $query = new FindTweetQuery($userName, (int)$request->get('limit'));

        $result = $this->handler->__invoke($query);

        return new JsonResponse($result);
    }
}
