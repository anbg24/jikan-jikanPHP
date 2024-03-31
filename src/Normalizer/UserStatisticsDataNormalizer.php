<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\UserStatisticsData;
use Jikan\JikanPHP\Model\UserStatisticsDataAnime;
use Jikan\JikanPHP\Model\UserStatisticsDataManga;
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
    class UserStatisticsDataNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return UserStatisticsData::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof UserStatisticsData;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $userStatisticsData = new UserStatisticsData();
            if (null === $data || !\is_array($data)) {
                return $userStatisticsData;
            }

            if (\array_key_exists('anime', $data)) {
                $userStatisticsData->setAnime($this->denormalizer->denormalize($data['anime'], UserStatisticsDataAnime::class, 'json', $context));
                unset($data['anime']);
            }

            if (\array_key_exists('manga', $data)) {
                $userStatisticsData->setManga($this->denormalizer->denormalize($data['manga'], UserStatisticsDataManga::class, 'json', $context));
                unset($data['manga']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $userStatisticsData[$key] = $value;
                }
            }

            return $userStatisticsData;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('anime') && null !== $object->getAnime()) {
                $data['anime'] = $this->normalizer->normalize($object->getAnime(), 'json', $context);
            }

            if ($object->isInitialized('manga') && null !== $object->getManga()) {
                $data['manga'] = $this->normalizer->normalize($object->getManga(), 'json', $context);
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
            return [UserStatisticsData::class => false];
        }
    }
} else {
    class UserStatisticsDataNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return UserStatisticsData::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof UserStatisticsData;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|UserStatisticsData
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $userStatisticsData = new UserStatisticsData();
            if (null === $data || !\is_array($data)) {
                return $userStatisticsData;
            }

            if (\array_key_exists('anime', $data)) {
                $userStatisticsData->setAnime($this->denormalizer->denormalize($data['anime'], UserStatisticsDataAnime::class, 'json', $context));
                unset($data['anime']);
            }

            if (\array_key_exists('manga', $data)) {
                $userStatisticsData->setManga($this->denormalizer->denormalize($data['manga'], UserStatisticsDataManga::class, 'json', $context));
                unset($data['manga']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $userStatisticsData[$key] = $value;
                }
            }

            return $userStatisticsData;
        }

        /**
         * @param null|mixed $format
         *
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('anime') && null !== $object->getAnime()) {
                $data['anime'] = $this->normalizer->normalize($object->getAnime(), 'json', $context);
            }

            if ($object->isInitialized('manga') && null !== $object->getManga()) {
                $data['manga'] = $this->normalizer->normalize($object->getManga(), 'json', $context);
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
            return [UserStatisticsData::class => false];
        }
    }
}
