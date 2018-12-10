<?php

namespace Gfg\Error\Handler;

class CustomErrorHandler
{
    public const HTTP_UNPROCESSABLE_ENTITY = 422;

    public function __invoke($request, $response, \Exception $exception)
    {
        $statusCode = $exception->getCode() ?: self::HTTP_UNPROCESSABLE_ENTITY;

        return $response->withJson(['error_msg' => $exception->getMessage(), 'error_type' => get_class($exception)], $statusCode);
    }
}
