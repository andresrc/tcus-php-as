<?php

namespace Derquinse\PhpAS\Controller;

use Derquinse\PhpAS\Model\Address;

/** Controller for Address entities. */
class AddressController
{
    private $addressService;

    public function __construct($addressService)
    {
        $this->addressService = $addressService;
    }

    public function ex()
    {
        $id = $_GET['id'];
        $address = $this->addressService->getAddressById($id);

        return json_encode($address);
    }
}
