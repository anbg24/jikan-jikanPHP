<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Exception;

use Psr\Http\Message\ResponseInterface;

class GetWatchRecentEpisodesBadRequestException extends BadRequestException
{
    public function __construct(private ?ResponseInterface $response = null)
    {
        parent::__construct('Error: Bad request. When required parameters were not supplied.');
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
