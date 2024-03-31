<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Model;

class MangaNews extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];

    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }

    /**
     * @var PaginationPagination
     */
    protected $pagination;

    /**
     * @var list<NewsDataItem>
     */
    protected $data = [];

    public function getPagination(): PaginationPagination
    {
        return $this->pagination;
    }

    public function setPagination(PaginationPagination $paginationPagination): self
    {
        $this->initialized['pagination'] = true;
        $this->pagination = $paginationPagination;

        return $this;
    }

    /**
     * @return list<NewsDataItem>
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param list<NewsDataItem> $data
     */
    public function setData(array $data): self
    {
        $this->initialized['data'] = true;
        $this->data = $data;

        return $this;
    }
}
