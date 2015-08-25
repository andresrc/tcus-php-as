<?php

namespace Derquinse\PhpAS\Module;

use Derquinse\PhpAS\Service as S;
use Derquinse\PhpAS\Controller as C;
use Derquinse\PhpAS\Data as D;

/**
 * We use a module abstraction to have a single point in which to wire up every component in this module.
 * A real application could be formed by several modules.
 * Think of a module like the set of built and configured objects provided by a dependency injection framework.
 */
class AddressModule
{
    /** Address repository. */
    private $addressRepository;

    /** Address service. */
    private $addressService;

    /** Address controller. */
    private $addressController;

    /**
     * Constructor. Wires the object based on the configuration.
     *
     * @param array Configuration.
     */
    public function __construct($config)
    {
        $this->addressRepository = new D\AddressRepositoryImpl($config['addresses.initialData'], $config['addresses.dataFile']);
        $this->addressService = new S\AddressServiceImpl($this->addressRepository);
        $this->addressController = new C\AddressController($this->addressService);
    }

    /**
     * @return D\AddressRepository Returns the address repository.
     */
    public function getAddressRepository()
    {
        return $this->addressRepository;
    }

    /**
     * @return S\AddressService Returns the address service.
     */
    public function getAddressService()
    {
        return $this->addressService;
    }

    /**
     * @return C\AddressController Returns the address controller.
     */
    public function getAddressController()
    {
        return $this->addressController;
    }
}
