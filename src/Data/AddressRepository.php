<?php

namespace Derquinse\PhpAS\Data;

use Derquinse\PhpAS\Model as M;

/**
 * Interface for an Addresses Repository.
 */
interface AddressRepository extends Repository
{
    /**
     * Loads an address by id.
     *
     * @return M\Address The address with the requested id or null if not found.
     */
    public function findById($id);

    /**
     * Returns all the known addresses.
     *
     * @return M\Address[] All the addresses.
     */
    public function findAll();
}
