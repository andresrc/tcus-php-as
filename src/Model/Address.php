<?php

namespace Derquinse\PhpAS\Model;

/**
 * Class representing the address entity in the system.
 * We assume only the name is mandatory.
 */
class Address
{
    /** Object id. */
    public $id;
    /** Person name. */
    public $name;
    /** Phone number. */
    public $phone;
    /** Stret address. */
    public $street;

    /**
     * Constructor. Is private as the object are constructed from the factory method below,
     * providing greater flexibility in the construction mechanism.
     */
    private function __construct($mixed)
    {
        if (isset($mixed['id'])) {
            $this->id = $mixed['id'];
        }
        $this->name = $mixed['name'];
        if (isset($mixed['phone'])) {
            $this->phone = $mixed['phone'];
        }
        if (isset($mixed['street'])) {
            $this->street = $mixed['street'];
        }
    }

    public static function fromArray($mixed)
    {
        if (!is_array($mixed)) {
            return;
        }
        if (!isset($mixed['name'])) {
            return;
        }

        return new self($mixed);
    }
}
