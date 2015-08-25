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

    /**
     * Constructor.
     *
     * @param string name File name to use to generate for seed data.
     */
    public function __construct($initialData)
    {
        $this->initialData = $initialData;
        parent::__construct($initialData);
    }

    /**
     * Loads an address by id.
     *
     * @return M\Address The address with the requested id or null if not found.
     */
    public function findById($id)
    {
        $addresses = $this->load();

        return $addresses[$id];
    }

    private function load()
    {
        $addresses = [];
        if (is_readable($this->initialData) && !is_dir($this->initialData)) {
            $file = fopen($this->initialData, 'r');
            if (is_resource($file)) {
                $id = 0;
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

        return $addresses;
    }

    /** Begins a transaction (internal). */
    protected function doBegin()
    {
    }

    /** Commits a transaction (internal). */
    protected function doCommit()
    {
    }

    /** Rolls back a transaction (internal). */
    protected function doRollback()
    {
    }
}
