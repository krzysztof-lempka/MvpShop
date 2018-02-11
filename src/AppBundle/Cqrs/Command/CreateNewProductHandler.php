<?php

namespace AppBundle\Cqrs\Command;

use Doctrine\ORM\EntityManager;
use AppBundle\Cqrs\Command\CreateNewProduct;
use AppBundle\Entity\Product;

/**
 * Handler class for CreateNewProduct command
 */
class CreateNewProductHandler
{
    private $entityManager;
    private $mailer;

    public function __construct(EntityManager $entityManager, \Swift_Mailer $mailer)
    {
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
    }

    /**
     * Creates new product and sends email notification
     */
    public function handle(CreateNewProduct $command) : void
    {
        $product = new Product();
        $product->setName($command->name());
        $product->setPrice($command->price());
        $product->setDescription($command->description());

        $this->entityManager->persist($product);
        $this->entityManager->flush();
        $name = $command->name();
        $message = (new \Swift_Message('Hello Email'))
           ->setFrom('fake@example.com')
           ->setTo('fake@example.com')
           ->setSubject('New product')
           ->setBody("A new product has been added. Product name: $name");

       $this->mailer->send($message);
    }
}
