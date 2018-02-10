<?php

namespace AppBundle\Cqrs\Command;

interface HandlerResolverInterface
{
    public function handler($command);
}
