<?php

namespace Derquinse\PhpAS\Controller;

use Derquinse\PhpAS\Request;
use Derquinse\PhpAS\Response;
use Derquinse\PhpAS\Model\Address;
use Derquinse\PhpAS\Model\AddressService;

/** Controller for Address entities. */
class AddressController
{
    private $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * Returns an address by id.
     *
     * @param request Request to execute.
     *
     * @return Response Response to send.
     */
    public function get(Request $request)
    {
        if (count($request->getPathSegments()) == 0) {
            $q = $request->getQuery();
            if (array_key_exists('id', $q)) {
                $id = $q['id'];
                $address = $this->addressService->getAddressById($id);
                if (isset($address)) {
                    return Response::ok($address);
                }
            }
        }

        return Response::notFound();
    }
}
