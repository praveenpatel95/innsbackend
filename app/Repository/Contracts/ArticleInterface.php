<?php

namespace App\Repository\Contracts;

interface ArticleInterface
{
    public function search(
        string $keyword,
        ?string $date = null,
        ?string $category = null,
        int $page,
        int $pageSize,
    );
}
