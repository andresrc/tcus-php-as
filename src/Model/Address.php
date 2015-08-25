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
            if (!is_numeric($mixed['id'])) {
                throw new \Exception('Invalid id');
            }
            $this->id = 0 + $mixed['id'];
        }
        $this->name = strval($mixed['name']);
        if (isset($mixed['phone'])) {
            $this->phone = strval($mixed['phone']);
        }
        if (isset($mixed['street'])) {
            $this->street = strval($mixed['street']);
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
