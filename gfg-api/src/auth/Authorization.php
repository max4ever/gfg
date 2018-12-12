<?php

namespace Gfg\Auth;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;

class Authorization
{
    private $sPassword;

    /**
     * Authorization constructor.
     * @param string $sPassword
     */
    public function __construct(string $sPassword)
    {
        $this->sPassword = $sPassword;
    }

    /**
     * Real basic authentication, just to demonstrate it works
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return Response
     */
    public function __invoke(Request $request, Response $response, callable $next)
    {
        $params = $request->getQueryParams();
        if (!empty($params['password']) && $params['password'] === $this->sPassword) {
            $response = $next($request, $response);
        } else {
            $response = $response->withJson(['error' => 'the password is missing'], StatusCode::HTTP_FORBIDDEN);
        }

        return $response;
    }

}