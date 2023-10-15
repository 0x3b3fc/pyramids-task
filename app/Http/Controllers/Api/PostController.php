<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Services\PostService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /***
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $posts = $this->postService->getAllPosts();
        return $this->sendResponse($posts, 'All Posts');
    }

    /***
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $post = $this->postService->createPost($request->all());
            return $this->sendResponse($post, 'Post Created Successfully!');
        } catch (Exception $exception) {
            return $this->sendError($exception->getMessage(), $exception->getCode());
        }
    }

    /***
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $post = Post::where('id', $id)->where('user_id', auth()->id())->first();
        if (!$post) {
            return $this->sendError('Post not found or you do not have permission.');
        }
        try {
            $updatedPost = $this->postService->updatePost($post, $request->all());
            return $this->sendResponse($updatedPost, 'Post Updated Successfully!');
        } catch (Exception $exception) {
            return $this->sendError($exception->getMessage(), $exception->getCode());
        }
    }

    /***
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $post = Post::where('id', $id)->where('user_id', auth()->id())->first();
        if (!$post) {
            return $this->sendError('Post not found or you do not have permission.');
        }
        $this->postService->deletePost($post);
        return $this->sendResponse([], 'Post Deleted Successfully!');
    }
}
