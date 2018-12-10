<?php

namespace Gfg\Error\Handler;

use Slim\Http\Response;

class CustomErrorHandler
{
    public const HTTP_UNPROCESSABLE_ENTITY = 422;

    /**
     * @param $request
     * @param Response $response
     * @param \Exception $exception
     * @return Response
     */
    public function __invoke($request, Response $response, \Exception $exception)
    {
        $statusCode = $exception->getCode() ?: self::HTTP_UNPROCESSABLE_ENTITY;

        return $response->withJson(['error_msg' => $exception->getMessage(), 'error_type' => get_class($exception)], $statusCode);
    }
}
