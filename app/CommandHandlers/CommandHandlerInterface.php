<?php

namespace App\CommandHandlers;

interface CommandHandlerInterface
{
    public function execute(PublishArticleCommand $command);
}
