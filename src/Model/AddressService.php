<?php

namespace Derquinse\PhpAS\Model;

/**
 * Interface for the AddressService.
 * Services encapsulate business logic and unit of work (e.g. transactions).
 * As they can depends on external services or repositories we define them by interface, to make it easier to introduce alternate implementations, such as mocks.
 */
interface AddressService
{
    /** Returns an address by id, or null if not found. */
    public function getAddressById($id);
}
