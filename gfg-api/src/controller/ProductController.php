<?php

namespace Gfg\Controller;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ProductController
{
    protected $container;

    const HTTP_OK = 200;

    // constructor receives container instance
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function get(Request $request, Response $response, $args)
    {
        $sTitleFilter = $request->getParam('q', null);

        if ('' === $sTitleFilter) {
            throw new \InvalidArgumentException('query cannot be empty');
        }

        //TODO move in another class
        $db = $this->container->db;
        /* @var $db \PDO */
        $sth = $db->prepare('SELECT * FROM products WHERE title LIKE ?');
        $sth->execute(["%" . $sTitleFilter . "%"]);
        $aResult = $sth->fetchAll();

        return $response->withJson($aResult, self::HTTP_OK);
    }

}