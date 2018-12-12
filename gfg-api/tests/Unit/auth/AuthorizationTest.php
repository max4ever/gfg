<?php

use Slim\Http\Request;
use Gfg\Auth\Authorization;
use Slim\Http\Response;

class AuthorizationTest extends PHPUnit_Framework_TestCase
{
    public function testAuthDenied(): void
    {

        $oRequest = $this->createMock(Request::class);
        $oRequest->method('getQueryParams')
            ->willReturn(['password' => 'wrong-password', 'something' => 'else']);

        $oResponse = new Response();

        $oAuth = new Authorization('correct-password');

        $accessAllowed = false;
        $oAuth->__invoke($oRequest, $oResponse, function ($a, $b) use (&$accessAllowed) {
            $accessAllowed = true;
        });

        $this->assertEquals($accessAllowed, false);
    }

    public function testAuthOk(): void
    {

        $oRequest = $this->createMock(Request::class);
        $oRequest->method('getQueryParams')
            ->willReturn(['password' => 'correct-password', 'something' => 'else']);

        $oResponse = new Response();

        $oAuth = new Authorization('correct-password');

        $accessAllowed = false;
        $oAuth->__invoke($oRequest, $oResponse, function ($a, $b) use (&$accessAllowed) {
            $accessAllowed = true;
        });

        $this->assertEquals($accessAllowed, true);
    }
}