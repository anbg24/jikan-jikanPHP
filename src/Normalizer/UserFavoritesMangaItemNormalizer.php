<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\MangaImages;
use Jikan\JikanPHP\Model\UserFavoritesMangaItem;
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
    class UserFavoritesMangaItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return UserFavoritesMangaItem::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof UserFavoritesMangaItem;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $userFavoritesMangaItem = new UserFavoritesMangaItem();
            if (null === $data || !\is_array($data)) {
                return $userFavoritesMangaItem;
            }

            if (\array_key_exists('type', $data)) {
                $userFavoritesMangaItem->setType($data['type']);
                unset($data['type']);
            }

            if (\array_key_exists('start_year', $data)) {
                $userFavoritesMangaItem->setStartYear($data['start_year']);
                unset($data['start_year']);
            }

            if (\array_key_exists('mal_id', $data)) {
                $userFavoritesMangaItem->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('url', $data)) {
                $userFavoritesMangaItem->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('images', $data)) {
                $userFavoritesMangaItem->setImages($this->denormalizer->denormalize($data['images'], MangaImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('title', $data)) {
                $userFavoritesMangaItem->setTitle($data['title']);
                unset($data['title']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $userFavoritesMangaItem[$key] = $value;
                }
            }

            return $userFavoritesMangaItem;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('type') && null !== $object->getType()) {
                $data['type'] = $object->getType();
            }

            if ($object->isInitialized('startYear') && null !== $object->getStartYear()) {
                $data['start_year'] = $object->getStartYear();
            }

            if ($object->isInitialized('malId') && null !== $object->getMalId()) {
                $data['mal_id'] = $object->getMalId();
            }

            if ($object->isInitialized('url') && null !== $object->getUrl()) {
                $data['url'] = $object->getUrl();
            }

            if ($object->isInitialized('images') && null !== $object->getImages()) {
                $data['images'] = $this->normalizer->normalize($object->getImages(), 'json', $context);
            }

            if ($object->isInitialized('title') && null !== $object->getTitle()) {
                $data['title'] = $object->getTitle();
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
            return [UserFavoritesMangaItem::class => false];
        }
    }
} else {
    class UserFavoritesMangaItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return UserFavoritesMangaItem::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof UserFavoritesMangaItem;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|UserFavoritesMangaItem
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $userFavoritesMangaItem = new UserFavoritesMangaItem();
            if (null === $data || !\is_array($data)) {
                return $userFavoritesMangaItem;
            }

            if (\array_key_exists('type', $data)) {
                $userFavoritesMangaItem->setType($data['type']);
                unset($data['type']);
            }

            if (\array_key_exists('start_year', $data)) {
                $userFavoritesMangaItem->setStartYear($data['start_year']);
                unset($data['start_year']);
            }

            if (\array_key_exists('mal_id', $data)) {
                $userFavoritesMangaItem->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('url', $data)) {
                $userFavoritesMangaItem->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('images', $data)) {
                $userFavoritesMangaItem->setImages($this->denormalizer->denormalize($data['images'], MangaImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('title', $data)) {
                $userFavoritesMangaItem->setTitle($data['title']);
                unset($data['title']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $userFavoritesMangaItem[$key] = $value;
                }
            }

            return $userFavoritesMangaItem;
        }

        /**
         * @param null|mixed $format
         *
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('type') && null !== $object->getType()) {
                $data['type'] = $object->getType();
            }

            if ($object->isInitialized('startYear') && null !== $object->getStartYear()) {
                $data['start_year'] = $object->getStartYear();
            }

            if ($object->isInitialized('malId') && null !== $object->getMalId()) {
                $data['mal_id'] = $object->getMalId();
            }

            if ($object->isInitialized('url') && null !== $object->getUrl()) {
                $data['url'] = $object->getUrl();
            }

            if ($object->isInitialized('images') && null !== $object->getImages()) {
                $data['images'] = $this->normalizer->normalize($object->getImages(), 'json', $context);
            }

            if ($object->isInitialized('title') && null !== $object->getTitle()) {
                $data['title'] = $object->getTitle();
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
            return [UserFavoritesMangaItem::class => false];
        }
    }
}
