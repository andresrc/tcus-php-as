<?php

namespace Derquinse\PhpAS\Data;

use Derquinse\PhpAS\Model\Address;

/**
 * Implementation of the AddressRepository.
 */
class AddressRepositoryImpl extends SemRepository implements AddressRepository
{
    /** Initial data file. */
    private $initialData;

    /** Data file. */
    private $dataFile;

    /** Id sequence. */
    private $seq;

    /** Loaded addresses. */
    private $addresses;

    /** Changes performed in the current tx. */
    private $changed;

    /** Whether there is an active tx. */
    private $tx;

    /**
     * Constructor.
     *
     * @param string initialData File name to use to generate for seed data.
     * @param string dataFile Data file name.
     */
    public function __construct($initialData, $dataFile)
    {
        $this->initialData = $initialData;
        $this->dataFile = $dataFile;
        parent::__construct($initialData);
        $this->seq = null;
        $this->addresses = null;
        $this->changed = false;
        $this->tx = false;
    }

    /** Ensures we are in a transaction. */
    private function checkTx()
    {
        if (!$this->tx) {
            throw new \Exception('Not in a transaction');
        }
    }

    /** Ensures we are not in a transaction. */
    private function checkNotTx()
    {
        if ($this->tx) {
            throw new \Exception('Already in a transaction');
        }
    }

    /**
     * Loads an address by id.
     *
     * @return M\Address The address with the requested id or null if not found.
     */
    public function findById($id)
    {
        $this->load();

        return $this->addresses[$id];
    }

    /**
     * Returns all the known addresses.
     *
     * @return M\Address[] All the addresses.
     */
    public function findAll()
    {
        $this->load();
        // Should make a defensive copy, skipped for the exercise.
        return array_values($this->addresses);
    }

    private function load()
    {
        $this->checkTx();
        if (!isset($this->seq)) {
            if (!is_readable($this->dataFile)) {
                $this->loadInitial();
                $this->saveData();
            } else {
                $this->loadData();
            }
        }
    }

    private function loadInitial()
    {
        $addresses = [];
        $id = 0;
        if (is_readable($this->initialData) && !is_dir($this->initialData)) {
            $file = fopen($this->initialData, 'r');
            if (is_resource($file)) {
                while (($line = fgetcsv($file)) !== false) {
                    ++$id;
                    $addresses[$id] = Address::fromArray([
                    id => $id,
                    name => $line[0],
                    phone => $line[1],
                    street => $line[2],
                    ]);
                }
            }
            fclose($file);
        }
        $this->addresses = $addresses;
        $this->seq = $id + 1;
    }

    private function loadData()
    {
        $addresses = [];
        $data = json_decode(file_get_contents($this->dataFile), true);
        $id = 0 + $data['seq'];
        foreach ($data['addresses'] as $d) {
            $a = Address::fromArray($d);
            $addresses[$a->id] = $a;
        }
        $this->addresses = $addresses;
        $this->seq = $id;
    }

    private function saveData()
    {
        $data = ['seq' => $this->seq, 'addresses' => array_values($this->addresses)];
        file_put_contents($this->dataFile, json_encode($data));
    }

    /** Begins a transaction (internal). */
    protected function doBegin()
    {
        $this->checkNotTx();
        $this->tx = true;
        $this->changed = false;
    }

    /** Commits a transaction (internal). */
    protected function doCommit()
    {
        $this->checkTx();
        if ($this->changed) {
            $this->saveData();
        }
        $this->tx = false;
        $this->changed = false;
    }

    /** Rolls back a transaction (internal). */
    protected function doRollback()
    {
        $this->checkTx();
        if ($this->changed) {
            // Force reload
            $this->seq = null;
            $this->addresses = null;
        }
        $this->tx = false;
        $this->changed = false;
    }
}
