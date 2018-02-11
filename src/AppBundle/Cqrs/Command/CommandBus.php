<?php

namespace AppBundle\Cqrs\Command;

use AppBundle\Cqrs\Command\CommandBusInterface;
use AppBundle\Cqrs\Command\HandlerResolverInterface;

/**
 * CommandBus gets instance of handler defined for passed command
 * and handles command execution
 */
class CommandBus implements CommandBusInterface
{
    private $handlerResolver;

    public function __construct(HandlerResolverInterface $handlerResolver)
    {
        $this->handlerResolver = $handlerResolver;
    }

    /**
     * Executes specific handler based on command type
     */
    public function handle($command) : void
    {
        $handler = $this->handlerResolver->handler($command);
        $handler->handle($command);
    }
}
