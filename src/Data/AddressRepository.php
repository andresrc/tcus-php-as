<?php

namespace Derquinse\PhpAS\Data;

use Derquinse\PhpAS\Model\Address;

/**
 * Interface for an Addresses Repository.
 */
interface AddressRepository extends Repository
{
    /**
     * Loads an address by id.
     *
     * @return Address The address with the requested id or null if not found.
     */
    public function findById($id);

    /**
     * Returns all the known addresses.
     *
     * @return Address[] All the addresses.
     */
    public function findAll();

    /**
     * Save a new address. If the id is not set or not found, a new one is generated.
     *
     * @param Address address Address to save.
     *
     * @return int Id of the saved address.
     */
    public function save($address);

    /**
     * Delete an address by id.
     *
     * @param int Id of the address to delete.
     *
     * @return bool True if found and deleted, false if not found.
     */
    public function delete($id);
}
