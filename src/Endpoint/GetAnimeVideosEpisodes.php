<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Endpoint;

use Jikan\JikanPHP\Exception\GetAnimeVideosEpisodesBadRequestException;
use Jikan\JikanPHP\Model\AnimeVideosEpisodes;
use Jikan\JikanPHP\Runtime\Client\BaseEndpoint;
use Jikan\JikanPHP\Runtime\Client\Endpoint;
use Jikan\JikanPHP\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class GetAnimeVideosEpisodes extends BaseEndpoint implements Endpoint
{
    /**
     * @param array $queryParameters {
     *
     * @var int $page
     *          }
     */
    public function __construct(protected int $id, array $queryParameters = [])
    {
        $this->queryParameters = $queryParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{id}'], [$this->id], '/anime/{id}/videos/episodes');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    protected function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function getQueryOptionsResolver(): OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['page']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('page', ['int']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     * @throws GetAnimeVideosEpisodesBadRequestException
     *
     * @return null|AnimeVideosEpisodes
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $statusCode = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (!is_null($contentType) && (200 === $statusCode && false !== mb_strpos($contentType, 'application/json'))) {
            return $serializer->deserialize($body, AnimeVideosEpisodes::class, 'json');
        }

        if (400 === $statusCode) {
            throw new GetAnimeVideosEpisodesBadRequestException($response);
        }
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
