<?php

namespace Derquinse\PhpAS\Controller;

use Derquinse\PhpAS\Request;
use Derquinse\PhpAS\Response;
use Derquinse\PhpAS\Controller;
use Derquinse\PhpAS\Model\Address;
use Derquinse\PhpAS\Service\AddressService;

/** Controller for Address entities. */
class AddressController implements Controller
{
    private $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * Returs the resource to use to serve a request related to the addresses collection.
     *
     * @param Request request Current request.
     *
     * @return Resource The resource to address with the requested id or null if not found.
     */
    public function getResource($request) {
        $p = $request->getPathSegments();
        $n = count($p);
        if ($n == 1) {
            if (is_numeric($p[0])) {
                $id = 0 + $p[0];
                return new AddressResource($this->addressService, $id);
            }
        } elseif ($n == 0) {
            return new AddressesResource($this->addressService);
        }
        return null;
    }
}
