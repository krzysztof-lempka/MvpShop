<?php

namespace AppBundle\Cqrs\Command;

interface CommandBusInterface
{
    public function handle($command) : void;
}
