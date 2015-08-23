<?php

namespace Derquinse\PhpAS\Controller;

use Derquinse\PhpAS\Model\Address;

/** Controller for Address entities. */
class AddressController
{
    private $addresses = [];

    public function ex()
    {
        $this->rcd();
        $id = $_GET['id'];
        $address = $this->addresses[$id];

        return json_encode($address);
    }

    public function rcd()
    {
        $file = fopen('example.csv', 'r');
        $id = 0;
        while (($line = fgetcsv($file)) !== false) {
            ++$id;
            $this->addresses[$id] = Address::fromArray([
            id => $id,
            name => $line[0],
            phone => $line[1],
            street => $line[2],
            ]);
        }

        fclose($file);
    }
}
