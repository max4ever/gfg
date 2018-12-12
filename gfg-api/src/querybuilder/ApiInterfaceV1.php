<?php

namespace Gfg\Querybuilder;

interface ApiInterfaceV1
{
    /**
     * Assembles the queries after you set the options
     * @return string query string
     */
    public function getResult(): string;

    /**
     * @param string $sFilter
     */
    public function setTitleFilter(string $sFilter): void;

    /**
     * @param string $sFilter
     */
    public function setBrandFilter(string $sFilter): void;

    /**
     * @param string $sFilter
     */
    public function setPriceFilter(string $sFilter): void;

    /**
     * @param string $sFilter
     */
    public function setStockFilter(string $sFilter): void;

    /**
     * @param bool $bOrderAsc
     */
    public function setStockOrder(bool $bOrderAsc): void;

    /**
     * @param bool $bOrderAsc
     */
    public function setBrandOrder(bool $bOrderAsc): void;

    /**
     * @param bool $bOrderAsc
     */
    public function setPriceOrder(bool $bOrderAsc): void;

    /**
     * @param bool $bOrderAsc
     */
    public function setTitleOrder(bool $bOrderAsc): void;
}