<?php

namespace Gfg\Querybuilder;

use Gfg\Error\BadLimitException;

class ApiV2 extends ApiV1 implements ApiInterfaceV2
{

    private $sLimitFrom;
    private $sLimitTo;

    /**
     * @param int $iStart
     */
    public function setLimitStart(int $iStart): void
    {
        $this->sLimitFrom = $iStart;
    }

    /**
     * @param int $iLimit
     */
    public function setLimit(int $iLimit): void
    {
        $this->sLimitTo = $iLimit;
    }

    /**
     * @return string
     * @throws BadLimitException
     */
    public function getResult(): string
    {
        $query = parent::getResult();

        if (!is_null($this->sLimitFrom) && !is_null($this->sLimitTo)) {
            if ($this->sLimitFrom > $this->sLimitTo) {
                throw new BadLimitException('limit start is bigger than limit end');
            }
            $query .= ' LIMIT ' . $this->sLimitFrom . ' , ' . $this->sLimitTo;
        }

        return $query;
    }
}