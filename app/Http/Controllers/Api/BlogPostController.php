<?php

namespace App\Http\Controllers\Api;

use App\DTOs\BlogPostDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BlogPostRequest;
use App\Http\Resources\Api\BlogPostResource;
use App\Models\BlogPost;
use App\Services\BlogPostService;
use Illuminate\Http\JsonResponse;

final class BlogPostController extends Controller
{
    public function __construct(protected BlogPostService $service)
    {
    }

    public function store(BlogPostRequest $request): JsonResponse
    {
        $post = $this->service->store(
            BlogPostDto::fromApiRequest($request)
        );

        return BlogPostResource::make($post);
    }

    public function update(BlogPostRequest $request, BlogPost $blogPost): JsonResponse
    {
        $post = $this->service->update(
            $blogPost,
            BlogPostDto::fromApiRequest($request)
        );

        return BlogPostResource::make($post);
    }
}
