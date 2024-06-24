<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleSearchRequest;
use App\Services\Article\ArticleService;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
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
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        $category = $request->category;
        $page = $request->page;

        $articles = $this->articleService
            ->setSource($source)
            ->setKeyword($keyword)
            ->setCategory($category)
            ->setFromDate($fromDate)
            ->setToDate($toDate)
            ->setPage($page)
            ->process();
        return $this->success($articles);
    }
}
