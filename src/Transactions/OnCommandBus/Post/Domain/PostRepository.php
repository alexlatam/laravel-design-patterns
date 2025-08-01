<?php

namespace Transactions\OnCommandBus\Post\Domain;

interface PostRepository
{
    public function store(Post $post): void;
}
