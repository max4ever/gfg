<?php

use Gfg\Helper\DbHelper;


class DbHelperTest extends PHPUnit_Framework_TestCase
{
    public function testSimpleQuery(): void
    {
        $oDbMock = $this->createMock(\PDO::class);
        $oStatementMock = $this->createMock(\PDOStatement::class);

        $oDbMock->method('prepare')
            ->willReturn($oStatementMock);

        $oStatementMock->method('execute')
            ->willReturn(true);

        $oStatementMock->method('fetchAll')
            ->willReturn(['count' => 100]);


        $dbHelper = new DbHelper($oDbMock);
        $this->assertEquals($dbHelper->getQueryResults('SELECT * FROM products')['count'], 100);
    }
}