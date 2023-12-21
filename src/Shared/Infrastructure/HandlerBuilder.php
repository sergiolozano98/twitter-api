<?php

namespace App\Shared\Infrastructure;

use ReflectionClass;
use ReflectionException;

final class HandlerBuilder
{
    /**
     * @throws ReflectionException
     */
    public static function fromCallables(iterable $callables): array
    {
        $callablesHandlers = [];

        foreach ($callables as $callable) {
            $envelop = self::extractFirstParam($callable);
            if (!array_key_exists($envelop, $callablesHandlers)) {
                $callablesHandlers[self::extractFirstParam($callable)] = [];
            }

            $callablesHandlers[self::extractFirstParam($callable)][] = $callable;
        }

        return $callablesHandlers;
    }

    /**
     * @throws ReflectionException
     */
    private static function extractFirstParam($class): ?string
    {
        $reflection = new ReflectionClass($class);
        $method = $reflection->getMethod('__invoke');

        if ($method->getNumberOfParameters() === 1) {
            $parameters = $method->getParameters();
            $parameter = $parameters[0];

            $class = $parameter->getClass();
            if ($class !== null) {
                return $class->getName();
            }
        }

        return null;
    }
}