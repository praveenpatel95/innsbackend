<?php

namespace App\Repository\Contracts;

interface ArticleInterface
{
    public function search(
        string $keyword,
        ?string $fromDate = null,
        ?string $toDate = null,
        ?string $category = null,
        int $page,
        int $pageSize,
    );
}
