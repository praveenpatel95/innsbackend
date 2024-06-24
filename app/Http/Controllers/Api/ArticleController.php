<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleSearchRequest;
use App\Services\Article\ArticleService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    use ApiResponse;

    /**
     * @param ArticleService $articleService
     */
    public function __construct(
        protected ArticleService $articleService
    )
    {}

    /**
     * @param ArticleSearchRequest $request
     * @return JsonResponse
     */
    public function search(ArticleSearchRequest $request): JsonResponse
    {
        $source = $request->source;
        $keyword = $request->keyword;
        $date = $request->date;
        $category = $request->category;
        $page = $request->page;

        $articles = $this->articleService
            ->setSource($source)
            ->setKeyword($keyword)
            ->setCategory($category)
            ->setDate($date)
            ->setPage($page)
            ->process();
        return $this->success($articles);
    }
}
