<?php

namespace Derquinse\PhpAS\Service;

use Derquinse\PhpAS\Model\Address;
use Derquinse\PhpAS\Data\AddressRepository;

/**
 * Implementation of the AddressService.
 */
class AddressServiceImpl implements AddressService
{
    /** Address Repository. */
    private $repository;

    /**
     * Constructor.
     *
     * @param AddressRepository Address Repository.
     */
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function getAddressById($id)
    {
        $this->repository->begin();
        $ok = false;
        try {
            $a = $this->repository->findById($id);
            $ok = true;

            return $a;
        } finally {
            if ($ok) {
                $this->repository->commit();
            } else {
                $this->repository->rollback();
            }
        }
    }

    /**
     * Returns all the known addresses.
     *
     * @return M\Address[] All the addresses.
     */
    public function getAddresses()
    {
        $this->repository->begin();
        $ok = false;
        try {
            $a = $this->repository->findAll();
            $ok = true;

            return $a;
        } finally {
            if ($ok) {
                $this->repository->commit();
            } else {
                $this->repository->rollback();
            }
        }
    }

    /**
     * Creates an address.
     *
     * @param Address address Address to insert.
     *
     * @return int id Created address id.
     */
    public function createAddress($address)
    {
        $this->repository->begin();
        $ok = false;
        try {
            unset($address->id);
            $id = $this->repository->save($address);
            $ok = true;

            return $id;
        } finally {
            if ($ok) {
                $this->repository->commit();
            } else {
                $this->repository->rollback();
            }
        }
    }

    /**
     * Updates an address.
     *
     * @param Address address Address to update.
     *
     * @return bool True if successful, false if not found.
     */
    public function updateAddress($address)
    {
        $this->repository->begin();
        $ok = false;
        try {
            $old = $this->repository->findById($address->id);
            $ret = false;
            if (isset($old)) {
                $this->repository->save($address);
                $ret = true;
            }
            $ok = true;

            return $ret;
        } finally {
            if ($ok) {
                $this->repository->commit();
            } else {
                $this->repository->rollback();
            }
        }
    }

    /**
     * Deletes an address.
     *
     * @param id address Address id to delete.
     *
     * @return bool True if successful, false if not found.
     */
    public function deleteAddress($id)
    {
        $this->repository->begin();
        $ok = false;
        try {
            $a = $this->repository->delete($id);
            $ok = true;

            return $a;
        } finally {
            if ($ok) {
                $this->repository->commit();
            } else {
                $this->repository->rollback();
            }
        }
    }
}
