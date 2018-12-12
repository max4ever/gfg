<?php

use Gfg\Querybuilder\ApiV1;

class ApiV1Test extends PHPUnit_Framework_TestCase
{
    public function testQueryNoFilter()
    {
        $api = new ApiV1($this->createMock(\PDO::class));

        $this->assertEquals('SELECT * FROM gfg.products  WHERE 1 ', $api->getResult());
    }
}