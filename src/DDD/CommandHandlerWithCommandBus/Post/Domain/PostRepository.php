<?php

namespace DDD\CommandHandlerWithCommandBus\Post\Domain;

interface PostRepository
{
    public function store(Post $post): void;
}
