<?php

namespace DDD\RealExample\Shared\Infrastructure\Event;

use DDD\RealExample\Shared\Domain\EventDispatcherInterface;
use Illuminate\Contracts\Events\Dispatcher as LaravelDispatcher;

class LaravelEventDispatcher implements EventDispatcherInterface
{
    public function __construct(private readonly LaravelDispatcher $dispatcher)
    {
    }

    public function dispatch(object $event): void
    {
        $this->dispatcher->dispatch($event);
    }
}
