<?php

namespace Derquinse\PhpAS\Model;

/**
 * Implementation of the AddressService.
 */
class AddressServiceImpl implements AddressService
{
    /** Returns an address by id, or null if not found. */
    public function getAddressById($id)
    {
        $addresses = $this->load();

        return $addresses[$id];
    }

    private function load()
    {
        $file = fopen('example.csv', 'r');
        $id = 0;
        $addresses = [];
        while (($line = fgetcsv($file)) !== false) {
            ++$id;
            $addresses[$id] = Address::fromArray([
            id => $id,
            name => $line[0],
            phone => $line[1],
            street => $line[2],
            ]);
        }
        fclose($file);

        return $addresses;
    }
}
