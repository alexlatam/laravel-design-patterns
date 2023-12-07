<?php

namespace App\Services;

use App\DTOs\BlogPostDto;
use App\Models\BlogPost;

class BlogPostService
{
    public function store(BlogPostDto $blogPostDto): BlogPost
    {
        return BlogPost::create([
            'title' => $blogPostDto->getTitle(),
            'content' => $blogPostDto->getContent(),
            'source' => $blogPostDto->getSource(),
        ]);
    }

    public function update(BlogPost $blogPost, BlogPostDto $blogPostDto): BlogPost
    {
        return tap($blogPost)->update([
            'title' => $blogPostDto->getTitle(),
            'content' => $blogPostDto->getContent(),
        ]);
    }
}
