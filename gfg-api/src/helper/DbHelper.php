<?php

namespace Gfg\Helper;

class DbHelper
{

    /**
     * Helper function to execute query and return results
     * @param string $qSql
     * @param \PDO $db
     * @return array
     */
    public static function getQueryResults(string $qSql, \PDO $db)
    {
        $sth = $db->prepare($qSql);
        $sth->execute();
        return $sth->fetchAll();
    }
}
