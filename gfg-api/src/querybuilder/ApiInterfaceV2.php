<?php

namespace Gfg\Querybuilder;

interface ApiInterfaceV2 extends ApiInterfaceV1
{
    /**
     * @param int $iStart
     */
    public function setLimitStart(int $iStart): void;

    /**
     * @param int $iLimit
     */
    public function setLimit(int $iLimit): void;

    /**
     * @return string
     * @throws \Gfg\Error\BadLimitException
     */
    public function getResult(): string;
}