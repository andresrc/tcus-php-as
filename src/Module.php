<?php

namespace Derquinse\PhpAS;

use Derquinse\PhpAS\Model as M;
use Derquinse\PhpAS\Controller as C;

/**
 * We use a module abstraction to have a single point in which to wire up every component in this module.
 * A real application could be formed by several modules.
 * Think of a module like the set of built and configured objects provided by a dependency injection framework.
 */
class Module
{
    /** Address service. */
    public $addressService;

    /** Address controller. */
    public $addressController;

    /** Constructor. Wires the object based on the configuration (TODO). */
    public function __construct($config)
    {
        $this->addressService = new M\AddressServiceImpl();
        $this->addressController = new C\AddressController($this->addressService);
    }
}
