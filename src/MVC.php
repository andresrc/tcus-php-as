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
     * @param controller Controller Controller object.
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
            $segments = $request->getPathSegments();
            if (count($segments) > 0) {
                $firstSegment = $segments[0];
                if (array_key_exists($firstSegment, $this->controllers)) {
                    $controller = $this->controllers[$firstSegment];
                    $controllerRequest = $request->consume();
                    $resource = $controller->getResource($controllerRequest);
                    if (isset($resource)) {
                        $verb = $request->getVerb();
                        if (method_exists($resource, $verb)) {
                            return $resource->$verb($controllerRequest);
                        } else {
                            return Response::notSupported();
                        }
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
