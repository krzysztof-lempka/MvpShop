<?php

namespace AppBundle\Cqrs\Command;

use AppBundle\Cqrs\Command\HandlerResolverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CommandHandlerResolver implements HandlerResolverInterface
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Gets handler instance based on command type.
     * The hanlder should be defind as service.
     *
     * @param object $command Command class instance
     */
    public function handler($command)
    {
        $handlerContainerName = $this->getHandlerName($command);

        if (!$this->container->has($handlerContainerName)) {
            throw new \Exception("There is no defined service for class " . get_class($command));
        }

        return $this->container->get($handlerContainerName);
    }

    /**
     * Returns handler service name for specific command
     * The handler should be defined as service.
     *
     * @param object $command Command class instance
     */
    private function getHandlerName($command) : string
    {
        $commandNamespace = explode('\\', get_class($command));
        $commandName = end($commandNamespace);
        $handlerName = str_replace('_command', '', $this->camelCaseToUnderscore($commandName));

        return 'app.command_handler.' . $handlerName;
    }

    private function camelCaseToUnderscore(string $input) : string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
    }
}
