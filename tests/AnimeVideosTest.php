<?php declare(strict_types=1);

use Jikan\JikanPHP\Model\AnimeVideos;
use Jikan\JikanPHP\Model\AnimeVideosData;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Serializer;
use Jikan\JikanPHP\Normalizer\JaneObjectNormalizer;
use PHPUnit\Framework\TestCase;

class AnimeVideosTest extends TestCase
{
    private function makeSerializer(): Serializer
    {
        return new Serializer([new JaneObjectNormalizer(), new ArrayDenormalizer()], [new JsonEncoder()]);
    }

    public function test_it_returns_null_when_data_is_missing(): void
    {
        $serializer = $this->makeSerializer();

        /** @var AnimeVideos $videos */
        $videos = $serializer->deserialize('{"pagination":{"has_next_page":false}}', AnimeVideos::class, 'json');

        self::assertFalse($videos->isInitialized('data'));
        self::assertNull($videos->getData());
    }

    public function test_it_deserializes_videos_data_when_present(): void
    {
        $serializer = $this->makeSerializer();

        /** @var AnimeVideos $videos */
        $videos = $serializer->deserialize('{"data":{"promo":[],"episodes":[],"music_videos":[]}}', AnimeVideos::class, 'json');

        self::assertTrue($videos->isInitialized('data'));
        self::assertInstanceOf(AnimeVideosData::class, $videos->getData());
        self::assertSame([], $videos->getData()->getPromo());
    }
}
