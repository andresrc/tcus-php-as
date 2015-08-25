<?php

namespace Derquinse\PhpAS\Controller;

use Derquinse\PhpAS\Request;
use Derquinse\PhpAS\Response;
use Derquinse\PhpAS\Model\Address;
use Derquinse\PhpAS\Service\AddressService;

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
        $p = $request->getPathSegments();
        $n = count($p);
        if ($n == 1) {
            if (is_numeric($p[0])) {
                $id = 0 + $p[0];
                $address = $this->addressService->getAddressById($id);
                if (isset($address)) {
                    return Response::ok($address);
                }
            }
        } elseif ($n == 0) {
            return Response::ok($this->addressService->getAddresses());
        }

        return Response::notFound();
    }
}
