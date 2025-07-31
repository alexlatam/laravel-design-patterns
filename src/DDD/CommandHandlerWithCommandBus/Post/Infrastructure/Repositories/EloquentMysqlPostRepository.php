<?php

namespace DDD\CommandHandlerWithCommandBus\Post\Infrastructure\Repositories;

use DDD\CommandHandlerWithCommandBus\Post\Domain\PostRepository;
use DDD\CommandHandlerWithCommandBus\Post\Domain\PostReviewCouldNotBeStoredException;
use DDD\CommandHandlerWithCommandBus\Post\Domain\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EloquentMysqlPostRepository implements PostRepository
{
    /**
     * @throws PostReviewCouldNotBeStoredException
     */
    public function store(Post $post): void
    {
        try {
            // insert a user for the post
            DB::insert("INSERT INTO users (id, name, email, password) VALUES (?, ?, ?, ?)",
                [
                    $post->authorId(),
                    'Alex Mont',
                    Str::random(10) . '@mail.com',
                    md5($post->content()),
                ]
            );

            DB::insert("INSERT INTO posts (id, title, content, author_id) VALUES (?, ?, ?, ?)",
                [
                    $post->id(),
                    $post->title(),
                    $post->content(),
                    $post->authorId(),
                ]
            );
        } catch (\Exception $e) {
            throw new PostReviewCouldNotBeStoredException();
        }
    }
}
