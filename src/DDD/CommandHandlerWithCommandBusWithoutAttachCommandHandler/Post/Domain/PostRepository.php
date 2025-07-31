<?php

namespace DDD\CommandHandlerWithCommandBusWithoutAttachCommandHandler\Post\Domain;

interface PostRepository
{
    public function store(Post $post): void;
}
