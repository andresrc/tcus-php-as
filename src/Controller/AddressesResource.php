<?php

namespace Derquinse\PhpAS\Controller;

use Derquinse\PhpAS\Request;
use Derquinse\PhpAS\Response;
use Derquinse\PhpAS\Resource;
use Derquinse\PhpAS\Model\Address;
use Derquinse\PhpAS\Service\AddressService;

/** Resource representing the addresses collection. */
class AddressesResource implements Resource
{
    /** Address service. */
    private $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * Process GET Requests, which returns all the elements in the collection.
     *
     * @param request Request to execute.
     *
     * @return Response Response to send.
     */
    public function get(Request $request)
    {
        return Response::ok($this->addressService->getAddresses());
    }

    /**
     * Process POST Requests, which appends a new address to the collection.
     *
     * @param request Request to execute.
     *
     * @return Response Response to send.
     */
    public function post(Request $request)
    {
        $a = Address::fromArray($request->getBody()); // TODO: improve error handling
        $id = $this->addressService->createAddress($a);
        if (!is_null($id)) {
            return Response::created("$id");
        } else {
            return Response::badRequest();
        }
    }
}
