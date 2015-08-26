<?php

namespace Derquinse\PhpAS;

/**
 * Nano MVC engine.
 * This object is used to build an application.
 * Controllers are registered based on the first path segment.
 * Controllers are called based on HTTP method name.
 */
class MVC
{
    /** Registered controllers. */
    private $controllers;

    /** Constructor. */
    public function __construct()
    {
        $this->controllers = array();
    }

    /**
     * Adds a controller.
     *
     * @param path string Path segment to map to the controller.
     * @param controller object Controller object.
     */
    public function addController($path, $controller)
    {
        $this->controllers[$path] = $controller;
    }

    /**
     * Executes a request.
     *
     * @param request Request to execute.
     *
     * @return Response Response to send.
     */
    public function execute(Request $request)
    {
        try {
            $p = $request->getPathSegments();
            if (count($p) > 0) {
                if (array_key_exists($p[0], $this->controllers)) {
                    $c = $this->controllers[$p[0]];
                    $v = $request->getVerb();
                    $r = $request->consume();
                    if (method_exists($c, $v)) {
                        return $c->$v($r);
                    } else {
                        return Response::notSupported();
                    }
                }
            }

            return Response::notFound();
        } catch (\Exception $e) {
            return Response::error($e->getMessage());
        }
    }

    public function run()
    {
        $request = Request::fromServer();
        $response = $this->execute($request);
        // In a real scenario, there would be some logic to choose the view
        // depending on request and response.
        $view = new JSONView();
        $view->render($response);
    }
}
