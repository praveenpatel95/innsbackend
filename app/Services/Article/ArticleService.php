<?php

namespace App\Services\Article;

use App\Mappers\NewsApiMapper;
use App\Repository\Contracts\ArticleInterface;

class ArticleService
{
    protected string $keyword;
    protected string $source;
    protected ?string $date = null;
    protected ?string $category = null;
    protected int $pageSize = 12;
    protected int $page = 1;

    /**
     * @param ArticleInterface $articleRepository
     */
    public function __construct(
        protected ArticleInterface $articleRepository,
        protected NewsApiMapper $mapper,
    )
    {}

    /**
     * @param string $source
     * @return $this
     */
    public function setSource(string $source): self
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @param string $keyword
     * @return $this
     */
    public function setKeyword(string $keyword): self
    {
        $this->keyword = $keyword;
        return $this;
    }

    /**
     * @param string|null $date
     * @return $this
     */
    public function setDate(?string $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @param string|null $category
     * @return $this
     */
    public function setCategory(?string $category): self
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @param int|null $page
     * @return $this
     */
    public function setPage(?int $page): self
    {
        $this->page = $page ?? $this->page;
        return $this;
    }

    /**
     * @return array
     */
    public function process(): array
    {
        $rawData = $this->articleRepository->search(
            $this->keyword,
            $this->date,
            $this->category,
            $this->page,
            $this->pageSize,
        );

        switch ($this->source) {
            case 'newsapi':
                return $this->mapper->transformNewsApiData($rawData);
            case 'nyt':
                return $this->mapper->transformNytData($rawData);
            case 'theguardian':
                return $this->mapper->transformGuardianData($rawData);
            default:
                throw new BadRequestException('Invalid source');
        }
    }
}
