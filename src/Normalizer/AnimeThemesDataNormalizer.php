<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\AnimeThemesData;
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
    class AnimeThemesDataNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return AnimeThemesData::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof AnimeThemesData;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $animeThemesData = new AnimeThemesData();
            if (null === $data || !\is_array($data)) {
                return $animeThemesData;
            }

            if (\array_key_exists('openings', $data)) {
                $values = [];
                foreach ($data['openings'] as $value) {
                    $values[] = $value;
                }

                $animeThemesData->setOpenings($values);
                unset($data['openings']);
            }

            if (\array_key_exists('endings', $data)) {
                $values_1 = [];
                foreach ($data['endings'] as $value_1) {
                    $values_1[] = $value_1;
                }

                $animeThemesData->setEndings($values_1);
                unset($data['endings']);
            }

            foreach ($data as $key => $value_2) {
                if (preg_match('#.*#', (string) $key)) {
                    $animeThemesData[$key] = $value_2;
                }
            }

            return $animeThemesData;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('openings') && null !== $object->getOpenings()) {
                $values = [];
                foreach ($object->getOpenings() as $opening) {
                    $values[] = $opening;
                }

                $data['openings'] = $values;
            }

            if ($object->isInitialized('endings') && null !== $object->getEndings()) {
                $values_1 = [];
                foreach ($object->getEndings() as $ending) {
                    $values_1[] = $ending;
                }

                $data['endings'] = $values_1;
            }

            foreach ($object as $key => $value_2) {
                if (preg_match('#.*#', (string) $key)) {
                    $data[$key] = $value_2;
                }
            }

            return $data;
        }

        public function getSupportedTypes(?string $format = null): array
        {
            return [AnimeThemesData::class => false];
        }
    }
} else {
    class AnimeThemesDataNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return AnimeThemesData::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof AnimeThemesData;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|AnimeThemesData
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $animeThemesData = new AnimeThemesData();
            if (null === $data || !\is_array($data)) {
                return $animeThemesData;
            }

            if (\array_key_exists('openings', $data)) {
                $values = [];
                foreach ($data['openings'] as $value) {
                    $values[] = $value;
                }

                $animeThemesData->setOpenings($values);
                unset($data['openings']);
            }

            if (\array_key_exists('endings', $data)) {
                $values_1 = [];
                foreach ($data['endings'] as $value_1) {
                    $values_1[] = $value_1;
                }

                $animeThemesData->setEndings($values_1);
                unset($data['endings']);
            }

            foreach ($data as $key => $value_2) {
                if (preg_match('#.*#', (string) $key)) {
                    $animeThemesData[$key] = $value_2;
                }
            }

            return $animeThemesData;
        }

        /**
         * @param null|mixed $format
         *
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('openings') && null !== $object->getOpenings()) {
                $values = [];
                foreach ($object->getOpenings() as $opening) {
                    $values[] = $opening;
                }

                $data['openings'] = $values;
            }

            if ($object->isInitialized('endings') && null !== $object->getEndings()) {
                $values_1 = [];
                foreach ($object->getEndings() as $ending) {
                    $values_1[] = $ending;
                }

                $data['endings'] = $values_1;
            }

            foreach ($object as $key => $value_2) {
                if (preg_match('#.*#', (string) $key)) {
                    $data[$key] = $value_2;
                }
            }

            return $data;
        }

        public function getSupportedTypes(?string $format = null): array
        {
            return [AnimeThemesData::class => false];
        }
    }
}
