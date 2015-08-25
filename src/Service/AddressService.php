<?php

namespace Derquinse\PhpAS\Service;

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
     * @return M\Address The address with the requested id or null if not found.
     */
    public function getAddressById($id);
}
