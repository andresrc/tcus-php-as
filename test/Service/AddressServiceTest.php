<?php

namespace Derquinse\PhpAS\Service;

/**
 * Tests for AddressService.
 *
 * @backupGlobals disabled
 */
class AddressServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testGetById()
    {
        global $addressModule;
        $s = $addressModule->getAddressService();
        $a = $s->getAddressById(3);
        $this->assertEquals(3, $a->id);
    }
}
