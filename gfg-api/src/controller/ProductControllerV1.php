<?php

namespace Gfg\Controller;

use Gfg\Helper\DbHelper;
use Gfg\Querybuilder\ApiInterfaceV1;
use Gfg\Querybuilder\ApiV1;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;

class ProductControllerV1
{
    protected $container;

    /**
     * ProductControllerV1 constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Responds to get queries on route /products
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function get(Request $request, Response $response, $args): Response
    {
        $sTitleFilter = $request->getParam('q', null);

        if ('' === $sTitleFilter) {
            throw new \InvalidArgumentException('query cannot be empty');
        }

        $oQueryBuilder = new ApiV1($this->container->db);
        $aQueryParams = $request->getQueryParams();

        $this->setFilters($oQueryBuilder, $aQueryParams);
        $this->setSorting($oQueryBuilder, $aQueryParams);
        $qSql = $oQueryBuilder->getResult();

//        $aResult['query'] = $qSql;
        $aResult['result'] = DbHelper::getQueryResults($qSql, $this->container->db);

        return $response->withJson($aResult, StatusCode::HTTP_OK);
    }

    /**
     * Sets the filter parameters
     * @param ApiInterfaceV1 $oQueryBuilder
     * @param $aQueryParams
     */
    protected function setFilters(ApiInterfacev1 $oQueryBuilder, $aQueryParams): void
    {
        if (!empty($aQueryParams['filter'])) {

            if (is_array($aQueryParams['filter'])) {
                $aFilters = $aQueryParams['filter'];
            } else {
                $aFilters = [$aQueryParams['filter']];
            }

            foreach ($aFilters as $sFilter) {
                list($sColumnName, $sFilterValue) = explode(':', $sFilter);//TODO what if : is in value...
                if ('brand' === $sColumnName) {
                    $oQueryBuilder->setBrandFilter($sFilterValue);
                } else if ('price' === $sColumnName) {
                    $oQueryBuilder->setPriceFilter($sFilterValue);
                } else if ('stock' === $sColumnName) {
                    $oQueryBuilder->setStockFilter($sFilterValue);
                }
            }
        }

        if (!empty($aQueryParams['q'])) {
            $oQueryBuilder->setTitleFilter($aQueryParams['q']);
        }
    }

    /**
     * Sets the order of the columns, e.g. 'title,-id' => title ASC, id DESC
     * @param ApiInterfaceV1 $oQueryBuilder
     * @param $aQueryParams
     */
    protected function setSorting(ApiInterfaceV1 $oQueryBuilder, $aQueryParams): void
    {
        if (!empty($aQueryParams['order'])) {

            $aColumns = explode(',', $aQueryParams['order']);

            foreach ($aColumns as $sColumnOrder) {

                if ($sColumnOrder[0] === '-') {
                    $bOrderAsc = false;
                    $sColumnName = substr($sColumnOrder, 1);

                } else {
                    $bOrderAsc = true;
                    $sColumnName = $sColumnOrder;
                }


                if ('brand' === $sColumnName) {
                    $oQueryBuilder->setBrandOrder($bOrderAsc);
                } else if ('price' === $sColumnName) {
                    $oQueryBuilder->setPriceOrder($bOrderAsc);
                } else if ('stock' === $sColumnName) {
                    $oQueryBuilder->setStockOrder($bOrderAsc);
                } else if ('title' === $sColumnName) {
                    $oQueryBuilder->setTitleOrder($bOrderAsc);
                }
            }
        }
    }
}