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
        try {
            return $this->repository->findById($id);
        } finally {
            $this->repository->commit();
        }
    }
}
