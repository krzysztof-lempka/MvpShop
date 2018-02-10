<?php

namespace AppBundle\Cqrs\Command;

/**
 *
 */
class CreateNewProduct
{
    private $name;
    private $price;
    private $description;

    public function __construct(string $name, float $price, string $description)
    {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function price() : float
    {
        return $this->price;
    }

    public function description() : string
    {
        return $this->description;
    }
}
