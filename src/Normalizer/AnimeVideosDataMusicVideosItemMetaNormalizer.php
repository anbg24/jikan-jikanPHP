<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\AnimeVideosDataMusicVideosItemMeta;
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
    class AnimeVideosDataMusicVideosItemMetaNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return AnimeVideosDataMusicVideosItemMeta::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof AnimeVideosDataMusicVideosItemMeta;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $animeVideosDataMusicVideosItemMeta = new AnimeVideosDataMusicVideosItemMeta();
            if (null === $data || !\is_array($data)) {
                return $animeVideosDataMusicVideosItemMeta;
            }

            if (\array_key_exists('title', $data) && null !== $data['title']) {
                $animeVideosDataMusicVideosItemMeta->setTitle($data['title']);
                unset($data['title']);
            } elseif (\array_key_exists('title', $data) && null === $data['title']) {
                $animeVideosDataMusicVideosItemMeta->setTitle(null);
            }

            if (\array_key_exists('author', $data) && null !== $data['author']) {
                $animeVideosDataMusicVideosItemMeta->setAuthor($data['author']);
                unset($data['author']);
            } elseif (\array_key_exists('author', $data) && null === $data['author']) {
                $animeVideosDataMusicVideosItemMeta->setAuthor(null);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $animeVideosDataMusicVideosItemMeta[$key] = $value;
                }
            }

            return $animeVideosDataMusicVideosItemMeta;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('title') && null !== $object->getTitle()) {
                $data['title'] = $object->getTitle();
            }

            if ($object->isInitialized('author') && null !== $object->getAuthor()) {
                $data['author'] = $object->getAuthor();
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
            return [AnimeVideosDataMusicVideosItemMeta::class => false];
        }
    }
} else {
    class AnimeVideosDataMusicVideosItemMetaNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return AnimeVideosDataMusicVideosItemMeta::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof AnimeVideosDataMusicVideosItemMeta;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|AnimeVideosDataMusicVideosItemMeta
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $animeVideosDataMusicVideosItemMeta = new AnimeVideosDataMusicVideosItemMeta();
            if (null === $data || !\is_array($data)) {
                return $animeVideosDataMusicVideosItemMeta;
            }

            if (\array_key_exists('title', $data) && null !== $data['title']) {
                $animeVideosDataMusicVideosItemMeta->setTitle($data['title']);
                unset($data['title']);
            } elseif (\array_key_exists('title', $data) && null === $data['title']) {
                $animeVideosDataMusicVideosItemMeta->setTitle(null);
            }

            if (\array_key_exists('author', $data) && null !== $data['author']) {
                $animeVideosDataMusicVideosItemMeta->setAuthor($data['author']);
                unset($data['author']);
            } elseif (\array_key_exists('author', $data) && null === $data['author']) {
                $animeVideosDataMusicVideosItemMeta->setAuthor(null);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $animeVideosDataMusicVideosItemMeta[$key] = $value;
                }
            }

            return $animeVideosDataMusicVideosItemMeta;
        }

        /**
         * @param null|mixed $format
         *
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('title') && null !== $object->getTitle()) {
                $data['title'] = $object->getTitle();
            }

            if ($object->isInitialized('author') && null !== $object->getAuthor()) {
                $data['author'] = $object->getAuthor();
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
            return [AnimeVideosDataMusicVideosItemMeta::class => false];
        }
    }
}
