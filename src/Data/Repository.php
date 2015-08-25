<?php

namespace Derquinse\PhpAS\Data;

/**
 * Base interfaces for Repositories.
 * Repositories encapsulate access to data sources. We are also including transaction management, that could be included in independent transaction managers.
 */
interface Repository
{
    /** Begins a transaction. */
    public function begin();

    /** Commits a transaction. */
    public function commit();

    /** Rolls back a transaction. */
    public function rollback();
}
