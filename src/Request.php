<?php

namespace Derquinse\PhpAS;

/**
 * Object representing a Request.
 * This object stores the exploded path, query parameters and request body (only if JSON object), decoded to arrays.
 */
class Request
{
    /** HTTP request verb. */
    private $verb;
    /** Remaining path segments from the request. */
    private $pathSegments;
    /** Query parameters. */
    private $query;
    /** Request body. */
    private $body;

    private static function param($p)
    {
        if (is_array($p)) {
            return $p;
        } else {
            return array();
        }
    }

    /** Constructor. */
    public function __construct($verb, $pathSegments, $query, $body)
    {
        $this->verb = strtolower(strval($verb));
        $this->pathSegments = self::param($pathSegments);
        $this->query = self::param($query);
        $this->body = self::param($body);
    }

    /**
     * @return string Returns the HTTP verb.
     */
    public function getVerb()
    {
        return $this->verb;
    }

    /**
     * @return array Returns the remaining path segments from the request.
     */
    public function getPathSegments()
    {
        return $this->pathSegments;
    }

    /**
     * @return array Returns the query parameters.
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @return array Returns the request body.
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return self Returns a new request that has consumed one path segment.
     */
    public function consume()
    {
        if (count($this->pathSegments) > 0) {
            $p = $this->pathSegments;
            array_shift($p);

            return new self($this->verb, array_values($p), $this->query, $this->body);
        }
        throw new \Exception('No remaining path segments to consume');
    }

    /** Builds a request from the _SERVER variable. */
    public static function fromServer()
    {
        $verb = $_SERVER['REQUEST_METHOD'];
        $path = explode('/', trim($_SERVER['PATH_INFO'], '/'));
        // Query string
        $parameters = array();
        if (isset($_SERVER['QUERY_STRING'])) {
            parse_str($_SERVER['QUERY_STRING'], $parameters);
        }
        // Body request if JSON
        $body = array();
        if (isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] == 'application/json') {
            $body = json_decode(file_get_contents('php://input'), true);
        }

        return new self($verb, $path, $parameters, $body);
    }
}
