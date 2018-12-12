<?php

namespace Gfg\Helper;

class DbHelper
{
    /**
     * @var \Pdo
     */
    private $db;

    public function __construct(\Pdo $db)
    {
        $this->db = $db;
    }

    /**
     * Helper function to execute query and return results
     * @param string $qSql
     * @param \PDO $db
     * @return array
     */
    public function getQueryResults(string $qSql)
    {
        $sth = $this->db->prepare($qSql);
        $sth->execute();
        return $sth->fetchAll();
    }
}
