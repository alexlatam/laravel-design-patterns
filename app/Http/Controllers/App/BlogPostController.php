<?php

namespace App\Http\Controllers\App;

use App\DTOs\BlogPostDto;
use App\Enums\BlogPostSource;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\BlogPostRequest;
use App\Http\Resources\App\BlogPostResource;
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
            BlogPostDto::fromAppRequest($request)
        );

        // Este metodo make indica la instancia que se usara en el resource [$this]
        // En este caso se usara el modelo Models/BlogPost
        return BlogPostResource::make($post);
    }

    public function update(BlogPostRequest $request, BlogPost $blogPost): JsonResponse
    {
        $post = $this->service->update(
            $blogPost,
            BlogPostDto::fromAppRequest($request)
        );

        return BlogPostResource::make($post);
    }
}
