<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Endpoint;

use Jikan\JikanPHP\Exception\GetCharacterAnimeBadRequestException;
use Jikan\JikanPHP\Model\CharacterAnime;
use Jikan\JikanPHP\Runtime\Client\BaseEndpoint;
use Jikan\JikanPHP\Runtime\Client\Endpoint;
use Jikan\JikanPHP\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class GetCharacterAnime extends BaseEndpoint implements Endpoint
{
    public function __construct(protected int $id)
    {
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{id}'], [$this->id], '/characters/{id}/anime');
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
     * @throws GetCharacterAnimeBadRequestException
     *
     * @return null|CharacterAnime
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $statusCode = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (!is_null($contentType) && (200 === $statusCode && false !== mb_strpos($contentType, 'application/json'))) {
            return $serializer->deserialize($body, CharacterAnime::class, 'json');
        }

        if (400 === $statusCode) {
            throw new GetCharacterAnimeBadRequestException($response);
        }
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
