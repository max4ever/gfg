<?php

namespace Gfg\Querybuilder;

class ApiV1 implements ApiInterfaceV1
{

    /**
     * @var \PDO
     */
    private $db;

    private $qSql = 'SELECT * FROM gfg.products ';
    private $qSqlWhere = ' WHERE 1 ';
    private $aOrderBy = [];

    /**
     * ApiV1 constructor.
     * @param \PDO $db
     */
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Assembles the queries after you set the options
     * @return string query string
     */
    public function getResult(): string
    {
        return $this->qSql . $this->qSqlWhere . $this->getOrderByQueryString();
    }

    /**
     * @return string
     */
    private function getOrderByQueryString(): string
    {
        $qOrderBy = '';
        if (!empty($this->aOrderBy)) {
            $qOrderBy = ' ORDER BY ';
            $qOrderBy .= implode(",", $this->aOrderBy);
        }

        return $qOrderBy;
    }
    //filter by

    /**
     * @param string $sFilter
     */
    public function setTitleFilter(string $sFilter): void
    {
        if (strlen($sFilter) > 0) {
            $this->qSqlWhere .= ' AND title LIKE ' . $this->db->quote('%' . $sFilter . '%') . ' ';
        }
    }

    /**
     * @param string $sFilter
     */
    public function setBrandFilter(string $sFilter): void
    {
        if (strlen($sFilter) > 0) {
            $this->qSqlWhere .= ' AND brand LIKE ' . $this->db->quote('%' . $sFilter . '%') . ' ';
        }
    }

    /**
     * @param string $sFilter
     */
    public function setPriceFilter(string $sFilter): void
    {
        if (strlen($sFilter) > 0) {
            $this->qSqlWhere .= ' AND price LIKE ' . $this->db->quote('%' . $sFilter . '%') . ' ';
        }
    }

    /**
     * @param string $sFilter
     */
    public function setStockFilter(string $sFilter): void
    {
        if (strlen($sFilter) > 0) {
            $this->qSqlWhere .= ' AND stock LIKE ' . $this->db->quote('%' . $sFilter . '%') . ' ';
        }
    }

    //order by

    /**
     * @param bool $bOrderAsc
     */
    public function setStockOrder(bool $bOrderAsc): void
    {
        $this->aOrderBy[] = ' stock ' . ((true === $bOrderAsc) ? 'ASC' : 'DESC');
    }

    /**
     * @param bool $bOrderAsc
     */
    public function setBrandOrder(bool $bOrderAsc): void
    {
        $this->aOrderBy[] = ' brand ' . ((true === $bOrderAsc) ? 'ASC' : 'DESC');
    }

    /**
     * @param bool $bOrderAsc
     */
    public function setPriceOrder(bool $bOrderAsc): void
    {
        $this->aOrderBy[] = ' price ' . ((true === $bOrderAsc) ? 'ASC' : 'DESC');
    }

    /**
     * @param bool $bOrderAsc
     */
    public function setTitleOrder(bool $bOrderAsc): void
    {
        $this->aOrderBy[] = ' title ' . ((true === $bOrderAsc) ? 'ASC' : 'DESC');
    }

}