<?php

namespace Derquinse\PhpAS;

use Derquinse\PhpAS\Model\Address;

/**
 * Marker interface for Resources.
 * The contract for resources is having a method named after the HTTP method for each supported one.
 * The method must have a Request parameter and return a Response.
 */
interface Resource
{
}
