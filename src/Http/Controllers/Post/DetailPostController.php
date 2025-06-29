<?php

namespace Dothcom\FrontReader\Http\Controllers\Post;

use Dothcom\FrontReader\Http\Controllers\BaseController;
use Dothcom\FrontReader\Services\PostService;

class DetailPostController extends BaseController
{
    public function index($slug = 'titulo-do-post')
    {
        $postService = new PostService();
        $post = $postService->getPostBySlug($slug, [
            '_embed' => 'featuredmedia,users,pages,tags,medias',
        ]);

        if (! $post) {
            return abort(404);
        }

        $template = $postService->templateByType($post->data->post_type);

        return view($template, ['post' => $post->data]);
    }
}
