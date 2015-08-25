<?php

namespace Derquinse\PhpAS\Service;

use Derquinse\PhpAS\Model\Address;

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

    public function testCreate()
    {
        $a = Address::fromArray(['name' => 'NewName']);
        $id = $this->service->createAddress($a);
        $created = $this->service->getAddressById($id);
        $this->assertEquals($created->name, $a->name);
    }

    public function testUpdate()
    {
        $old = $this->service->getAddressById(2);
        $old->name = 'Name2';
        $this->assertTrue($this->service->updateAddress($old));
        $updated = $this->service->getAddressById(2);
        $this->assertEquals($updated->name, $old->name);
    }

    public function testDelete()
    {
        $a = $this->service->getAddressById(4);
        $this->assertEquals(4, $a->id);
        $this->assertTrue($this->service->deleteAddress(4));
        $this->assertNull($this->service->getAddressById(4));
    }
}
