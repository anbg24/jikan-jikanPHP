<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Endpoint;

use Jikan\JikanPHP\Exception\GetClubsByIdBadRequestException;
use Jikan\JikanPHP\Model\ClubsIdGetResponse200;
use Jikan\JikanPHP\Runtime\Client\BaseEndpoint;
use Jikan\JikanPHP\Runtime\Client\Endpoint;
use Jikan\JikanPHP\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class GetClubsById extends BaseEndpoint implements Endpoint
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
        return str_replace(['{id}'], [$this->id], '/clubs/{id}');
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
     * @throws GetClubsByIdBadRequestException
     *
     * @return null|ClubsIdGetResponse200
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $statusCode = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (!is_null($contentType) && (200 === $statusCode && false !== mb_strpos($contentType, 'application/json'))) {
            return $serializer->deserialize($body, ClubsIdGetResponse200::class, 'json');
        }

        if (400 === $statusCode) {
            throw new GetClubsByIdBadRequestException($response);
        }
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
