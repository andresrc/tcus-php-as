<?php

namespace Derquinse\PhpAS;

/**
 * Object representing a JSON view.
 */
class JSONView extends View
{
    /**
     * Renders the entity as JSON.
     *
     * @param mixed Entity.
     */
    protected function renderEntity($entity)
    {
        header('Content-Type: application/json; charset=utf8');
        echo json_encode($entity);
    }
}
