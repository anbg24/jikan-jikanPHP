<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\AnimeImagesJpg;
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
    class AnimeImagesJpgNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return AnimeImagesJpg::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof AnimeImagesJpg;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $animeImagesJpg = new AnimeImagesJpg();
            if (null === $data || !\is_array($data)) {
                return $animeImagesJpg;
            }

            if (\array_key_exists('image_url', $data) && null !== $data['image_url']) {
                $animeImagesJpg->setImageUrl($data['image_url']);
                unset($data['image_url']);
            } elseif (\array_key_exists('image_url', $data) && null === $data['image_url']) {
                $animeImagesJpg->setImageUrl(null);
            }

            if (\array_key_exists('small_image_url', $data) && null !== $data['small_image_url']) {
                $animeImagesJpg->setSmallImageUrl($data['small_image_url']);
                unset($data['small_image_url']);
            } elseif (\array_key_exists('small_image_url', $data) && null === $data['small_image_url']) {
                $animeImagesJpg->setSmallImageUrl(null);
            }

            if (\array_key_exists('large_image_url', $data) && null !== $data['large_image_url']) {
                $animeImagesJpg->setLargeImageUrl($data['large_image_url']);
                unset($data['large_image_url']);
            } elseif (\array_key_exists('large_image_url', $data) && null === $data['large_image_url']) {
                $animeImagesJpg->setLargeImageUrl(null);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $animeImagesJpg[$key] = $value;
                }
            }

            return $animeImagesJpg;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('imageUrl') && null !== $object->getImageUrl()) {
                $data['image_url'] = $object->getImageUrl();
            }

            if ($object->isInitialized('smallImageUrl') && null !== $object->getSmallImageUrl()) {
                $data['small_image_url'] = $object->getSmallImageUrl();
            }

            if ($object->isInitialized('largeImageUrl') && null !== $object->getLargeImageUrl()) {
                $data['large_image_url'] = $object->getLargeImageUrl();
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
            return [AnimeImagesJpg::class => false];
        }
    }
} else {
    class AnimeImagesJpgNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return AnimeImagesJpg::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof AnimeImagesJpg;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|AnimeImagesJpg
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $animeImagesJpg = new AnimeImagesJpg();
            if (null === $data || !\is_array($data)) {
                return $animeImagesJpg;
            }

            if (\array_key_exists('image_url', $data) && null !== $data['image_url']) {
                $animeImagesJpg->setImageUrl($data['image_url']);
                unset($data['image_url']);
            } elseif (\array_key_exists('image_url', $data) && null === $data['image_url']) {
                $animeImagesJpg->setImageUrl(null);
            }

            if (\array_key_exists('small_image_url', $data) && null !== $data['small_image_url']) {
                $animeImagesJpg->setSmallImageUrl($data['small_image_url']);
                unset($data['small_image_url']);
            } elseif (\array_key_exists('small_image_url', $data) && null === $data['small_image_url']) {
                $animeImagesJpg->setSmallImageUrl(null);
            }

            if (\array_key_exists('large_image_url', $data) && null !== $data['large_image_url']) {
                $animeImagesJpg->setLargeImageUrl($data['large_image_url']);
                unset($data['large_image_url']);
            } elseif (\array_key_exists('large_image_url', $data) && null === $data['large_image_url']) {
                $animeImagesJpg->setLargeImageUrl(null);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $animeImagesJpg[$key] = $value;
                }
            }

            return $animeImagesJpg;
        }

        /**
         * @param null|mixed $format
         *
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('imageUrl') && null !== $object->getImageUrl()) {
                $data['image_url'] = $object->getImageUrl();
            }

            if ($object->isInitialized('smallImageUrl') && null !== $object->getSmallImageUrl()) {
                $data['small_image_url'] = $object->getSmallImageUrl();
            }

            if ($object->isInitialized('largeImageUrl') && null !== $object->getLargeImageUrl()) {
                $data['large_image_url'] = $object->getLargeImageUrl();
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
            return [AnimeImagesJpg::class => false];
        }
    }
}
