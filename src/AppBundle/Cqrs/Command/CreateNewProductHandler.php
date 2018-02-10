<?php

namespace AppBundle\Cqrs\Command;

use Doctrine\ORM\EntityManager;
use AppBundle\Cqrs\Command\CreateNewProduct;
use AppBundle\Entity\Product;

class CreateNewProductHandler
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(CreateNewProduct $command) : void
    {
        $product = new Product();
        $product->setName($command->name());
        $product->setPrice($command->price());
        $product->setDescription($command->description());

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        //TODO mail notification
    }
}
