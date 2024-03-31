<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\UsersTempDataItem;
use Jikan\JikanPHP\Model\UsersTempDataItemAnimeStats;
use Jikan\JikanPHP\Model\UsersTempDataItemFavorites;
use Jikan\JikanPHP\Model\UsersTempDataItemImages;
use Jikan\JikanPHP\Model\UsersTempDataItemMangaStats;
use Jikan\JikanPHP\Runtime\Normalizer\CheckArray;
use Jikan\JikanPHP\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

if (!class_exists(Kernel::class) || (Kernel::MAJOR_VERSION >= 7 || Kernel::MAJOR_VERSION === 6 && Kernel::MINOR_VERSION === 4)) {
    class UsersTempDataItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return UsersTempDataItem::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof UsersTempDataItem;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $usersTempDataItem = new UsersTempDataItem();
            if (null === $data || !\is_array($data)) {
                return $usersTempDataItem;
            }

            if (\array_key_exists('mal_id', $data)) {
                $usersTempDataItem->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('username', $data)) {
                $usersTempDataItem->setUsername($data['username']);
                unset($data['username']);
            }

            if (\array_key_exists('url', $data)) {
                $usersTempDataItem->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('images', $data)) {
                $usersTempDataItem->setImages($this->denormalizer->denormalize($data['images'], UsersTempDataItemImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('last_online', $data)) {
                $usersTempDataItem->setLastOnline($data['last_online']);
                unset($data['last_online']);
            }

            if (\array_key_exists('gender', $data)) {
                $usersTempDataItem->setGender($data['gender']);
                unset($data['gender']);
            }

            if (\array_key_exists('birthday', $data)) {
                $usersTempDataItem->setBirthday($data['birthday']);
                unset($data['birthday']);
            }

            if (\array_key_exists('location', $data)) {
                $usersTempDataItem->setLocation($data['location']);
                unset($data['location']);
            }

            if (\array_key_exists('joined', $data)) {
                $usersTempDataItem->setJoined($data['joined']);
                unset($data['joined']);
            }

            if (\array_key_exists('anime_stats', $data)) {
                $usersTempDataItem->setAnimeStats($this->denormalizer->denormalize($data['anime_stats'], UsersTempDataItemAnimeStats::class, 'json', $context));
                unset($data['anime_stats']);
            }

            if (\array_key_exists('manga_stats', $data)) {
                $usersTempDataItem->setMangaStats($this->denormalizer->denormalize($data['manga_stats'], UsersTempDataItemMangaStats::class, 'json', $context));
                unset($data['manga_stats']);
            }

            if (\array_key_exists('favorites', $data)) {
                $usersTempDataItem->setFavorites($this->denormalizer->denormalize($data['favorites'], UsersTempDataItemFavorites::class, 'json', $context));
                unset($data['favorites']);
            }

            if (\array_key_exists('about', $data)) {
                $usersTempDataItem->setAbout($data['about']);
                unset($data['about']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $usersTempDataItem[$key] = $value;
                }
            }

            return $usersTempDataItem;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('malId') && null !== $object->getMalId()) {
                $data['mal_id'] = $object->getMalId();
            }

            if ($object->isInitialized('username') && null !== $object->getUsername()) {
                $data['username'] = $object->getUsername();
            }

            if ($object->isInitialized('url') && null !== $object->getUrl()) {
                $data['url'] = $object->getUrl();
            }

            if ($object->isInitialized('images') && null !== $object->getImages()) {
                $data['images'] = $this->normalizer->normalize($object->getImages(), 'json', $context);
            }

            if ($object->isInitialized('lastOnline') && null !== $object->getLastOnline()) {
                $data['last_online'] = $object->getLastOnline();
            }

            if ($object->isInitialized('gender') && null !== $object->getGender()) {
                $data['gender'] = $object->getGender();
            }

            if ($object->isInitialized('birthday') && null !== $object->getBirthday()) {
                $data['birthday'] = $object->getBirthday();
            }

            if ($object->isInitialized('location') && null !== $object->getLocation()) {
                $data['location'] = $object->getLocation();
            }

            if ($object->isInitialized('joined') && null !== $object->getJoined()) {
                $data['joined'] = $object->getJoined();
            }

            if ($object->isInitialized('animeStats') && null !== $object->getAnimeStats()) {
                $data['anime_stats'] = $this->normalizer->normalize($object->getAnimeStats(), 'json', $context);
            }

            if ($object->isInitialized('mangaStats') && null !== $object->getMangaStats()) {
                $data['manga_stats'] = $this->normalizer->normalize($object->getMangaStats(), 'json', $context);
            }

            if ($object->isInitialized('favorites') && null !== $object->getFavorites()) {
                $data['favorites'] = $this->normalizer->normalize($object->getFavorites(), 'json', $context);
            }

            if ($object->isInitialized('about') && null !== $object->getAbout()) {
                $data['about'] = $object->getAbout();
            }

            foreach ($object as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $data[$key] = $value;
                }
            }

            return $data;
        }

        public function getSupportedTypes(?string $format = null): array
        {
            return [UsersTempDataItem::class => false];
        }
    }
} else {
    class UsersTempDataItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return UsersTempDataItem::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof UsersTempDataItem;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|UsersTempDataItem
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $usersTempDataItem = new UsersTempDataItem();
            if (null === $data || !\is_array($data)) {
                return $usersTempDataItem;
            }

            if (\array_key_exists('mal_id', $data)) {
                $usersTempDataItem->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('username', $data)) {
                $usersTempDataItem->setUsername($data['username']);
                unset($data['username']);
            }

            if (\array_key_exists('url', $data)) {
                $usersTempDataItem->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('images', $data)) {
                $usersTempDataItem->setImages($this->denormalizer->denormalize($data['images'], UsersTempDataItemImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('last_online', $data)) {
                $usersTempDataItem->setLastOnline($data['last_online']);
                unset($data['last_online']);
            }

            if (\array_key_exists('gender', $data)) {
                $usersTempDataItem->setGender($data['gender']);
                unset($data['gender']);
            }

            if (\array_key_exists('birthday', $data)) {
                $usersTempDataItem->setBirthday($data['birthday']);
                unset($data['birthday']);
            }

            if (\array_key_exists('location', $data)) {
                $usersTempDataItem->setLocation($data['location']);
                unset($data['location']);
            }

            if (\array_key_exists('joined', $data)) {
                $usersTempDataItem->setJoined($data['joined']);
                unset($data['joined']);
            }

            if (\array_key_exists('anime_stats', $data)) {
                $usersTempDataItem->setAnimeStats($this->denormalizer->denormalize($data['anime_stats'], UsersTempDataItemAnimeStats::class, 'json', $context));
                unset($data['anime_stats']);
            }

            if (\array_key_exists('manga_stats', $data)) {
                $usersTempDataItem->setMangaStats($this->denormalizer->denormalize($data['manga_stats'], UsersTempDataItemMangaStats::class, 'json', $context));
                unset($data['manga_stats']);
            }

            if (\array_key_exists('favorites', $data)) {
                $usersTempDataItem->setFavorites($this->denormalizer->denormalize($data['favorites'], UsersTempDataItemFavorites::class, 'json', $context));
                unset($data['favorites']);
            }

            if (\array_key_exists('about', $data)) {
                $usersTempDataItem->setAbout($data['about']);
                unset($data['about']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $usersTempDataItem[$key] = $value;
                }
            }

            return $usersTempDataItem;
        }

        /**
         * @param null|mixed $format
         *
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('malId') && null !== $object->getMalId()) {
                $data['mal_id'] = $object->getMalId();
            }

            if ($object->isInitialized('username') && null !== $object->getUsername()) {
                $data['username'] = $object->getUsername();
            }

            if ($object->isInitialized('url') && null !== $object->getUrl()) {
                $data['url'] = $object->getUrl();
            }

            if ($object->isInitialized('images') && null !== $object->getImages()) {
                $data['images'] = $this->normalizer->normalize($object->getImages(), 'json', $context);
            }

            if ($object->isInitialized('lastOnline') && null !== $object->getLastOnline()) {
                $data['last_online'] = $object->getLastOnline();
            }

            if ($object->isInitialized('gender') && null !== $object->getGender()) {
                $data['gender'] = $object->getGender();
            }

            if ($object->isInitialized('birthday') && null !== $object->getBirthday()) {
                $data['birthday'] = $object->getBirthday();
            }

            if ($object->isInitialized('location') && null !== $object->getLocation()) {
                $data['location'] = $object->getLocation();
            }

            if ($object->isInitialized('joined') && null !== $object->getJoined()) {
                $data['joined'] = $object->getJoined();
            }

            if ($object->isInitialized('animeStats') && null !== $object->getAnimeStats()) {
                $data['anime_stats'] = $this->normalizer->normalize($object->getAnimeStats(), 'json', $context);
            }

            if ($object->isInitialized('mangaStats') && null !== $object->getMangaStats()) {
                $data['manga_stats'] = $this->normalizer->normalize($object->getMangaStats(), 'json', $context);
            }

            if ($object->isInitialized('favorites') && null !== $object->getFavorites()) {
                $data['favorites'] = $this->normalizer->normalize($object->getFavorites(), 'json', $context);
            }

            if ($object->isInitialized('about') && null !== $object->getAbout()) {
                $data['about'] = $object->getAbout();
            }

            foreach ($object as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $data[$key] = $value;
                }
            }

            return $data;
        }

        public function getSupportedTypes(?string $format = null): array
        {
            return [UsersTempDataItem::class => false];
        }
    }
}
