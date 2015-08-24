<?php

namespace Derquinse\PhpAS\Model;

/**
 * Implementation of the AddressService.
 */
class AddressServiceImpl implements AddressService
{
    /** Initial data file. */
    private $initialData;

    /** Constructor. */
    public function __construct($initialData)
    {
        $this->initialData = $initialData;
    }

    /** Returns an address by id, or null if not found. */
    public function getAddressById($id)
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
}
