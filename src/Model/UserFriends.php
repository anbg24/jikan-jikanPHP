<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Model;

class UserFriends extends \ArrayObject
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
     * @var list<array<string, mixed>>
     */
    protected $data = [];

    /**
     * @var PaginationPagination
     */
    protected $pagination;

    /**
     * @return list<array<string, mixed>>
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param list<array<string, mixed>> $data
     */
    public function setData(array $data): self
    {
        $this->initialized['data'] = true;
        $this->data = $data;

        return $this;
    }

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
}
