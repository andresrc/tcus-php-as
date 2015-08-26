<?php

namespace Derquinse\PhpAS;

/**
 * Abstract base class for a view.
 */
abstract class View
{
    /** Renders a response. */
    final public function render(Response $response)
    {
        foreach ($response->getHeaders() as $h) {
            header($h);
        }
        http_response_code($response->getStatus());
        $e = $response->getEntity();
        if (!is_null($e)) {
            $this->renderEntity($e);
        }
    }

    /**
     * Renders the entity.
     *
     * @param mixed Entity.
     */
    abstract protected function renderEntity($entity);
}
