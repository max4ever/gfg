<?php

namespace Gfg\Controller;

use Gfg\Helper\DbHelper;
use Gfg\Querybuilder\ApiInterfaceV2;
use Gfg\Querybuilder\ApiV2;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;

class ProductControllerV2 extends ProductControllerV1
{

    public function get(Request $request, Response $response, $args): Response
    {
        $sTitleFilter = $request->getParam('q', null);

        if ('' === $sTitleFilter) {
            throw new \InvalidArgumentException('query cannot be empty');
        }

        $oQueryBuilder = new ApiV2($this->container->db);

        $aQueryParams = $request->getQueryParams();

        $this->setFilters($oQueryBuilder, $aQueryParams);
        $this->setSorting($oQueryBuilder, $aQueryParams);
        $this->setLimits($oQueryBuilder, $aQueryParams);
        $qSql = $oQueryBuilder->getResult();

//        $aResult['query'] = $qSql;
        $aResult['result'] = DbHelper::getQueryResults($qSql, $this->container->db);
        $aResult['totalRows'] = DbHelper::getQueryResults("SELECT COUNT(*) as count FROM products", $this->container->db)[0]['count'];

        return $response->withJson($aResult, StatusCode::HTTP_OK);
    }

    /**
     * Sets the filter parameters
     * @param ApiInterfaceV2 $oQueryBuilder
     * @param $aQueryParams
     */
    protected function setLimits(ApiInterfaceV2 $oQueryBuilder, array $aQueryParams): void
    {
        if ($aQueryParams['start'] != '' && ctype_digit($aQueryParams['start'])) {
            $oQueryBuilder->setLimitStart((int)$aQueryParams['start']);
        }

        if (!empty($aQueryParams['limit']) && ctype_digit($aQueryParams['limit'])) {
            $oQueryBuilder->setLimit((int)$aQueryParams['limit']);
        }
    }

}