<?php

namespace Hex\Shared;

interface CommandHandler
{
    public function execute(Command $command): Response;
}
