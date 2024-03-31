<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Endpoint;

use Jikan\JikanPHP\Exception\GetWatchRecentEpisodesBadRequestException;
use Jikan\JikanPHP\Model\WatchEpisodes;
use Jikan\JikanPHP\Runtime\Client\BaseEndpoint;
use Jikan\JikanPHP\Runtime\Client\Endpoint;
use Jikan\JikanPHP\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class GetWatchRecentEpisodes extends BaseEndpoint implements Endpoint
{
    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return '/watch/episodes';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    protected function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    /**
     * {@inheritdoc}
     *
     * @throws GetWatchRecentEpisodesBadRequestException
     *
     * @return null|WatchEpisodes
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $statusCode = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (!is_null($contentType) && (200 === $statusCode && false !== mb_strpos($contentType, 'application/json'))) {
            return $serializer->deserialize($body, WatchEpisodes::class, 'json');
        }

        if (400 === $statusCode) {
            throw new GetWatchRecentEpisodesBadRequestException($response);
        }
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
