<?php

namespace Derquinse\PhpAS\Controller;

use Derquinse\PhpAS\Request;
use Derquinse\PhpAS\Response;
use Derquinse\PhpAS\Resource;
use Derquinse\PhpAS\Model\Address;
use Derquinse\PhpAS\Service\AddressService;

/** Controller for Address entities. */
class AddressResource implements Resource
{
    /** Address service. */
    private $addressService;
    /** Address id. */
    private $addressId;

    public function __construct(AddressService $addressService, $addressId)
    {
        $this->addressService = $addressService;
        $this->addressId = $addressId;
    }

    /**
     * Process GET Requests. Returns the requested address.
     *
     * @param request Request to execute.
     *
     * @return Response Response to send.
     */
    public function get(Request $request)
    {
        $address = $this->addressService->getAddressById($this->addressId);
        if (isset($address)) {
            return Response::ok($address);
        }
        return Response::notFound();
    }

    /**
     * Process PUT Requests. Updates an existing address.
     *
     * @param request Request to execute.
     *
     * @return Response Response to send.
     */
    public function put(Request $request)
    {
        $a = Address::fromArray($request->getBody()); // TODO: improve error handling
        if ($this->addressService->updateAddress($a)) {
            return Response::ok();
        }
        return Response::notFound();
    }

    /**
     * Process DELETE Requests. Deletes an existing address.
     *
     * @param request Request to execute.
     *
     * @return Response Response to send.
     */
    public function delete(Request $request)
    {
        if ($this->addressService->deleteAddress($this->addressId)) {
            return Response::ok();
        }
        return Response::notFound();
    }
}
