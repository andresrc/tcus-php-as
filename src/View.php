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
        http_response_code($response->getStatus());
        foreach ($response->getHeaders() as $h) {
            header(h);
        }
        $e = $response->getEntity();
        if (isset($e)) {
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
