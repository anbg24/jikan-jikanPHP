<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\MangaImages;
use Jikan\JikanPHP\Model\MangaImagesJpg;
use Jikan\JikanPHP\Model\MangaImagesWebp;
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
    class MangaImagesNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return MangaImages::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof MangaImages;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $mangaImages = new MangaImages();
            if (null === $data || !\is_array($data)) {
                return $mangaImages;
            }

            if (\array_key_exists('jpg', $data)) {
                $mangaImages->setJpg($this->denormalizer->denormalize($data['jpg'], MangaImagesJpg::class, 'json', $context));
                unset($data['jpg']);
            }

            if (\array_key_exists('webp', $data)) {
                $mangaImages->setWebp($this->denormalizer->denormalize($data['webp'], MangaImagesWebp::class, 'json', $context));
                unset($data['webp']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $mangaImages[$key] = $value;
                }
            }

            return $mangaImages;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('jpg') && null !== $object->getJpg()) {
                $data['jpg'] = $this->normalizer->normalize($object->getJpg(), 'json', $context);
            }

            if ($object->isInitialized('webp') && null !== $object->getWebp()) {
                $data['webp'] = $this->normalizer->normalize($object->getWebp(), 'json', $context);
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
            return [MangaImages::class => false];
        }
    }
} else {
    class MangaImagesNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return MangaImages::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof MangaImages;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|MangaImages
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $mangaImages = new MangaImages();
            if (null === $data || !\is_array($data)) {
                return $mangaImages;
            }

            if (\array_key_exists('jpg', $data)) {
                $mangaImages->setJpg($this->denormalizer->denormalize($data['jpg'], MangaImagesJpg::class, 'json', $context));
                unset($data['jpg']);
            }

            if (\array_key_exists('webp', $data)) {
                $mangaImages->setWebp($this->denormalizer->denormalize($data['webp'], MangaImagesWebp::class, 'json', $context));
                unset($data['webp']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $mangaImages[$key] = $value;
                }
            }

            return $mangaImages;
        }

        /**
         * @param null|mixed $format
         *
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('jpg') && null !== $object->getJpg()) {
                $data['jpg'] = $this->normalizer->normalize($object->getJpg(), 'json', $context);
            }

            if ($object->isInitialized('webp') && null !== $object->getWebp()) {
                $data['webp'] = $this->normalizer->normalize($object->getWebp(), 'json', $context);
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
            return [MangaImages::class => false];
        }
    }
}
