<?php

namespace Gfg\Controller;

use Gfg\Querybuilder\ApiInterface;
use Gfg\Querybuilder\ApiV1;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ProductController
{
    protected $container;

    const HTTP_OK = 200;

    /**
     * ProductController constructor.
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

        /* @var $db \PDO */
        $db = $this->container->db;
        $sth = $db->prepare($qSql);
        $sth->execute();
        $aResult['query'] = $qSql;
        $aResult['result'] = $sth->fetchAll();

        return $response->withJson($aResult, self::HTTP_OK);
    }

    /**
     * Sets the filter parameters
     * @param ApiInterface $oQueryBuilder
     * @param $aQueryParams
     */
    private function setFilters(ApiInterface $oQueryBuilder, $aQueryParams): void
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
     * @param ApiInterface $oQueryBuilder
     * @param $aQueryParams
     */
    private function setSorting(ApiInterface $oQueryBuilder, $aQueryParams): void
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