<?php

namespace Derquinse\PhpAS;

/**
 * Object representing a Response. Only JSON entity types are supported.
 */
class Response
{
    /** HTTP status code. */
    private $status;
    /** HTTP headers. */
    private $headers;
    /** Response entity. */
    private $entity;

    /** Constructor. */
    public function __construct($status, $entity)
    {
        if (is_numeric($status)) {
            $this->status = $status + 0;
        } else {
            throw new \Exception('Invalid status code.');
        }
        $this->headers = array();
        $this->entity = $entity;
    }

    /**
     * @return array Returns the status code.
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return array Returns the response headers.
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return array Returns the response entity.
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Adds a header to the response.
     *
     * @param h string Header.
     */
    public function addHeader($h)
    {
        $this->headers[] = strval($h);
    }

    /** Builds an OK response. */
    public static function ok($entity = null)
    {
        return new self(200, $entity);
    }

    /** Builds a NOT FOUND response. */
    public static function notFound($entity = null)
    {
        return new self(404, $entity);
    }

    /** Builds a NOT SUPPORTED response. */
    public static function notSupported($entity = null)
    {
        return new self(405, $entity);
    }

    /** Builds a BAD REQUEST response. */
    public static function badRequest()
    {
        return new self(400, null);
    }


    /** Builds an ERROR response. */
    public static function error($msg)
    {
        return new self(500, ['error' => strval($msg)]);
    }

    /** Builds a CREATED response. */
    public static function created($url)
    {
        $r = new self(201, null);
        $r->addHeader("Location: $url");

        return $r;
    }
}
