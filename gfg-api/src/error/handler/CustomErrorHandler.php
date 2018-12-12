<?php

namespace Gfg\Error\Handler;

use Slim\Http\Response;
use Slim\Http\StatusCode;

class CustomErrorHandler
{
    /**
     * @param $request
     * @param Response $response
     * @param \Exception $exception
     * @return Response
     */
    public function __invoke($request, Response $response, \Exception $exception)
    {
        $statusCode = $exception->getCode() ?: StatusCode::HTTP_UNPROCESSABLE_ENTITY;

        return $response->withJson(['error_msg' => $exception->getMessage(), 'error_type' => get_class($exception)], $statusCode);
    }
}
