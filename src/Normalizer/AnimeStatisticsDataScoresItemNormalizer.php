<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\AnimeStatisticsDataScoresItem;
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
    class AnimeStatisticsDataScoresItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return AnimeStatisticsDataScoresItem::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof AnimeStatisticsDataScoresItem;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $animeStatisticsDataScoresItem = new AnimeStatisticsDataScoresItem();
            if (\array_key_exists('percentage', $data) && \is_int($data['percentage'])) {
                $data['percentage'] = (float) $data['percentage'];
            }

            if (null === $data || !\is_array($data)) {
                return $animeStatisticsDataScoresItem;
            }

            if (\array_key_exists('score', $data)) {
                $animeStatisticsDataScoresItem->setScore($data['score']);
                unset($data['score']);
            }

            if (\array_key_exists('votes', $data)) {
                $animeStatisticsDataScoresItem->setVotes($data['votes']);
                unset($data['votes']);
            }

            if (\array_key_exists('percentage', $data)) {
                $animeStatisticsDataScoresItem->setPercentage($data['percentage']);
                unset($data['percentage']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $animeStatisticsDataScoresItem[$key] = $value;
                }
            }

            return $animeStatisticsDataScoresItem;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('score') && null !== $object->getScore()) {
                $data['score'] = $object->getScore();
            }

            if ($object->isInitialized('votes') && null !== $object->getVotes()) {
                $data['votes'] = $object->getVotes();
            }

            if ($object->isInitialized('percentage') && null !== $object->getPercentage()) {
                $data['percentage'] = $object->getPercentage();
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
            return [AnimeStatisticsDataScoresItem::class => false];
        }
    }
} else {
    class AnimeStatisticsDataScoresItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return AnimeStatisticsDataScoresItem::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof AnimeStatisticsDataScoresItem;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|AnimeStatisticsDataScoresItem
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $animeStatisticsDataScoresItem = new AnimeStatisticsDataScoresItem();
            if (\array_key_exists('percentage', $data) && \is_int($data['percentage'])) {
                $data['percentage'] = (float) $data['percentage'];
            }

            if (null === $data || !\is_array($data)) {
                return $animeStatisticsDataScoresItem;
            }

            if (\array_key_exists('score', $data)) {
                $animeStatisticsDataScoresItem->setScore($data['score']);
                unset($data['score']);
            }

            if (\array_key_exists('votes', $data)) {
                $animeStatisticsDataScoresItem->setVotes($data['votes']);
                unset($data['votes']);
            }

            if (\array_key_exists('percentage', $data)) {
                $animeStatisticsDataScoresItem->setPercentage($data['percentage']);
                unset($data['percentage']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $animeStatisticsDataScoresItem[$key] = $value;
                }
            }

            return $animeStatisticsDataScoresItem;
        }

        /**
         * @param null|mixed $format
         *
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('score') && null !== $object->getScore()) {
                $data['score'] = $object->getScore();
            }

            if ($object->isInitialized('votes') && null !== $object->getVotes()) {
                $data['votes'] = $object->getVotes();
            }

            if ($object->isInitialized('percentage') && null !== $object->getPercentage()) {
                $data['percentage'] = $object->getPercentage();
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
            return [AnimeStatisticsDataScoresItem::class => false];
        }
    }
}
