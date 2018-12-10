<?php

namespace Gfg\Auth;

use Slim\Http\Request;
use Slim\Http\Response;

class Authorization
{

    const HTTP_ERROR_FORBIDDEN = 403;
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
        if (!empty($params['password']) && $params['password'] === $this->sPassword){
            $response = $next($request, $response);
        }
        else{
            $response = $response->withJson(['error' => 'the password is missing'], self::HTTP_ERROR_FORBIDDEN);
        }

        return $response;
    }

}