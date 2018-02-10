<?php

namespace AppBundle\Cqrs\Command;

use AppBundle\Cqrs\Command\CommandBusInterface;
use AppBundle\Cqrs\Command\HandlerResolverInterface;

class CommandBus implements CommandBusInterface
{
    private $handlerResolver;

    public function __construct(HandlerResolverInterface $handlerResolver)
    {
        $this->handlerResolver = $handlerResolver;
    }

    public function handle($command) : void
    {
        $handler = $this->handlerResolver->handler($command);
        $handler->handle($command);
    }
}
