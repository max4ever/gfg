<?php

use Gfg\Controller\ProductControllerV2;
use Gfg\Helper\DbHelper;
use Slim\Http\StatusCode;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ProductControllerV2Test extends PHPUnit_Framework_TestCase
{

    public function testReturnCodeOk()
    {

        $containerInterfaceMock = $this->createMock(ContainerInterface::class);

        $oStatementMock = $this->createMock(\PDOStatement::class);

        $oDbMock = $this->createMock(\PDO::class);
        $oDbMock->method('prepare')
            ->willReturn($oStatementMock);

        $oStatementMock->method('execute')
            ->willReturn(true);

        $oStatementMock->method('fetchAll')
            ->willReturn(['count' => 100]);


        $containerInterfaceMock->db = $oDbMock;
        $dbHelperMock = $this->getMockBuilder(DbHelper::class)->disableOriginalConstructor()->getMock();

        $controller = new ProductControllerV2($containerInterfaceMock, $dbHelperMock);

        $oRequest = $this->createMock(Request::class);
        $oRequest->method('getQueryParams')
            ->willReturn(['password' => 'wrong-password', 'something' => 'else']);

        $response = $controller->get($oRequest, new Response(), []);
        $this->assertEquals(StatusCode::HTTP_OK, $response->getStatusCode());
    }
}