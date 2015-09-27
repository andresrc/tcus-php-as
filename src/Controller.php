<?php

namespace Derquinse\PhpAS;

/**
 * Interface for a Controller.
 * Controllers route requestes to resources.
 */
interface Controller
{
    /**
     * Returs the resource to use to serve a request.
     *
     * @param Request request Current request.
     *
     * @return Resource The resource to address with the requested id or null if not found.
     */
    public function getResource($request);
}
