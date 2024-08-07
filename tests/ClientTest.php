<?php declare(strict_types=1);

use Jikan\JikanPHP\Client;
use Jikan\JikanPHP\Model\AnimeIdGetResponse200;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function test_it_gets_anime(): void
    {
        $jikan = Client::create();
        /** @var AnimeIdGetResponse200 $response */
        $response = $jikan->getAnimeById(5114);
        $anime = $response->getData();
        self::assertEquals('Fullmetal Alchemist: Brotherhood', $anime->getTitle());
    }

    public function test_it_gets_anim2(): void
    {
        $jikan = Client::create();
        /** @var AnimeIdGetResponse200 $response */
        $response = $jikan->getAnimeById(5114);
        $anime = $response->getData();
        self::assertEquals(5114, $anime->getMalId());
    }

    public function test_it_gets_anim3(): void
    {
        $jikan = Client::create();
        /** @var AnimeIdGetResponse200 $response */
        $response = $jikan->getAnimeById(50385);
        $anime = $response->getData();
        self::assertEquals(50385, $anime->getMalId());
    }
}
