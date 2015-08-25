<?php

namespace Derquinse\PhpAS\Data;

/**
 * Base class for repositories that implement transaction control using a semaphore.
 */
abstract class SemRepository
{
    /** Semaphore key. */
    private $semKey;
    /** Semaphore id. */
    private $semId;
    /** Transaction nesting count. */
    private $count;
    /** Whether the transaction is set for rollback. */
    private $rollBackOnly;

    /**
     * Constructor.
     *
     * @param string name File name to use to generate the semaphore key.
     */
    public function __construct($name)
    {
        $this->count = 0;
        $this->semKey = ftok($name, 'R');
        $this->semId = sem_get($this->semKey);
        if (!is_resource($this->semId)) {
            throw new \Exception('Unable to create semaphore');
        }
    }

    /** Begins a transaction. */
    final public function begin()
    {
        if ($this->count > 0) {
            ++$this->count;
        } else {
            sem_acquire($this->semId);
            $this->count = 1;
            $this->rollBackOnly = false;
            $this->doBegin();
        }
    }

    /** Begins a transaction (internal). */
    abstract protected function doBegin();

    /** Commits a transaction. */
    public function commit()
    {
        if ($this->rollBackOnly == true) {
            rollback();

            return;
        }
        --$this->count;
        if ($this->count == 0) {
            try {
                $this->doCommit();
            } finally {
                sem_release($this->semId);
            }
        }
    }

    /** Commits a transaction (internal). */
    abstract protected function doCommit();

    /** Rolls back a transaction. */
    final public function rollback()
    {
        $this->rollBackOnly == true;
        --$this->count;
        if ($this->count == 0) {
            try {
                $this->doRollback();
            } finally {
                sem_release($this->semId);
            }
        }
    }

    /** Rolls back a transaction (internal). */
    abstract protected function doRollback();
}
