<?php

namespace Derquinse\PhpAS\Service;

/**
 * Tests for AddressService.
 *
 * @backupGlobals disabled
 */
class AddressServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $service;

    public function setUp()
    {
        global $addressModule;
        $this->service = $addressModule->getAddressService();
    }

    public function testGetById()
    {
        $a = $this->service->getAddressById(3);
        $this->assertEquals(3, $a->id);
    }

    public function testGetAll()
    {
        $all = $this->service->getAddresses();
        $this->assertTrue(is_array($all));
        $this->assertTrue(count($all) > 0);
        foreach ($all as $a) {
            $this->assertInstanceOf('Derquinse\PhpAS\Model\Address', $a);
        }
    }
}
