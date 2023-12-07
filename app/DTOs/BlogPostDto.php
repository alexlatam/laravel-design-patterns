<?php

namespace App\DTOs;

use App\Enums\BlogPostSource;
use App\Http\Requests\Api\BlogPostRequest as ApiBlogPostRequest;
use App\Http\Requests\App\BlogPostRequest as AppBlogPostRequest;

class BlogPostDto
{
    public function __construct(
        public string $title,
        public string $content,
        public BlogPostSource $source,
    ) {
    }

    public static function fromAppRequest(AppBlogPostRequest $request): self
    {
        return new self(
            title: $request->validated('title'),
            content: $request->validated('content'),
            source: $request->validated('source'),
        );
    }

    public static function fromApiRequest(ApiBlogPostRequest $request): self
    {
        return new self(
            title: $request->validated('payload.title'),
            content: $request->validated('payload.content'),
            source: $request->validated('payload.source'),
        );
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getSource(): BlogPostSource
    {
        return $this->source;
    }
}
