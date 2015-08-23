<?php

namespace Derquinse\PhpAS\Model;

/**
 * Tests for Address.
 */
class AddressTest extends \PHPUnit_Framework_TestCase
{
    public function testValid()
    {
        $input = [id => 3, name => 'Name', phone => '555', street => 'Street and Name'];
        $a = Address::fromArray($input);
        $this->assertEquals($input['id'], $a->id);
        $this->assertEquals($input['name'], $a->name);
        $this->assertEquals($input['phone'], $a->phone);
        $this->assertEquals($input['street'], $a->street);
    }
}
