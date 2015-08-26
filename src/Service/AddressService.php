<?php

namespace Derquinse\PhpAS\Service;

use Derquinse\PhpAS\Model\Address;

/**
 * Interface for the AddressService.
 * Services encapsulate business logic and unit of work (e.g. transactions).
 * As they can depends on external services or repositories we define them by interface, to make it easier to introduce alternate implementations, such as mocks.
 */
interface AddressService
{
    /**
     * Returs an address by id.
     *
     * @return Address The address with the requested id or null if not found.
     */
    public function getAddressById($id);

    /**
     * Returns all the known addresses.
     *
     * @return Address[] All the addresses.
     */
    public function getAddresses();

    /**
     * Creates an address.
     *
     * @param Address address Address to insert.
     *
     * @return int id Created address id.
     */
    public function createAddress($address);

    /**
     * Updates an address.
     *
     * @param Address address Address to update.
     *
     * @return bool True if successful, false if not found.
     */
    public function updateAddress($address);

    /**
     * Deletes an address.
     *
     * @param id address Address id to delete.
     *
     * @return bool True if successful, false if not found.
     */
    public function deleteAddress($id);
}
