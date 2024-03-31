<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\AnimeUserupdatesdataItem;
use Jikan\JikanPHP\Model\UserMeta;
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
    class AnimeUserupdatesdataItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return AnimeUserupdatesdataItem::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof AnimeUserupdatesdataItem;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $animeUserupdatesdataItem = new AnimeUserupdatesdataItem();
            if (null === $data || !\is_array($data)) {
                return $animeUserupdatesdataItem;
            }

            if (\array_key_exists('user', $data)) {
                $animeUserupdatesdataItem->setUser($this->denormalizer->denormalize($data['user'], UserMeta::class, 'json', $context));
                unset($data['user']);
            }

            if (\array_key_exists('score', $data) && null !== $data['score']) {
                $animeUserupdatesdataItem->setScore($data['score']);
                unset($data['score']);
            } elseif (\array_key_exists('score', $data) && null === $data['score']) {
                $animeUserupdatesdataItem->setScore(null);
            }

            if (\array_key_exists('status', $data)) {
                $animeUserupdatesdataItem->setStatus($data['status']);
                unset($data['status']);
            }

            if (\array_key_exists('episodes_seen', $data) && null !== $data['episodes_seen']) {
                $animeUserupdatesdataItem->setEpisodesSeen($data['episodes_seen']);
                unset($data['episodes_seen']);
            } elseif (\array_key_exists('episodes_seen', $data) && null === $data['episodes_seen']) {
                $animeUserupdatesdataItem->setEpisodesSeen(null);
            }

            if (\array_key_exists('episodes_total', $data) && null !== $data['episodes_total']) {
                $animeUserupdatesdataItem->setEpisodesTotal($data['episodes_total']);
                unset($data['episodes_total']);
            } elseif (\array_key_exists('episodes_total', $data) && null === $data['episodes_total']) {
                $animeUserupdatesdataItem->setEpisodesTotal(null);
            }

            if (\array_key_exists('date', $data)) {
                $animeUserupdatesdataItem->setDate($data['date']);
                unset($data['date']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $animeUserupdatesdataItem[$key] = $value;
                }
            }

            return $animeUserupdatesdataItem;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('user') && null !== $object->getUser()) {
                $data['user'] = $this->normalizer->normalize($object->getUser(), 'json', $context);
            }

            if ($object->isInitialized('score') && null !== $object->getScore()) {
                $data['score'] = $object->getScore();
            }

            if ($object->isInitialized('status') && null !== $object->getStatus()) {
                $data['status'] = $object->getStatus();
            }

            if ($object->isInitialized('episodesSeen') && null !== $object->getEpisodesSeen()) {
                $data['episodes_seen'] = $object->getEpisodesSeen();
            }

            if ($object->isInitialized('episodesTotal') && null !== $object->getEpisodesTotal()) {
                $data['episodes_total'] = $object->getEpisodesTotal();
            }

            if ($object->isInitialized('date') && null !== $object->getDate()) {
                $data['date'] = $object->getDate();
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
            return [AnimeUserupdatesdataItem::class => false];
        }
    }
} else {
    class AnimeUserupdatesdataItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return AnimeUserupdatesdataItem::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof AnimeUserupdatesdataItem;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|AnimeUserupdatesdataItem
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $animeUserupdatesdataItem = new AnimeUserupdatesdataItem();
            if (null === $data || !\is_array($data)) {
                return $animeUserupdatesdataItem;
            }

            if (\array_key_exists('user', $data)) {
                $animeUserupdatesdataItem->setUser($this->denormalizer->denormalize($data['user'], UserMeta::class, 'json', $context));
                unset($data['user']);
            }

            if (\array_key_exists('score', $data) && null !== $data['score']) {
                $animeUserupdatesdataItem->setScore($data['score']);
                unset($data['score']);
            } elseif (\array_key_exists('score', $data) && null === $data['score']) {
                $animeUserupdatesdataItem->setScore(null);
            }

            if (\array_key_exists('status', $data)) {
                $animeUserupdatesdataItem->setStatus($data['status']);
                unset($data['status']);
            }

            if (\array_key_exists('episodes_seen', $data) && null !== $data['episodes_seen']) {
                $animeUserupdatesdataItem->setEpisodesSeen($data['episodes_seen']);
                unset($data['episodes_seen']);
            } elseif (\array_key_exists('episodes_seen', $data) && null === $data['episodes_seen']) {
                $animeUserupdatesdataItem->setEpisodesSeen(null);
            }

            if (\array_key_exists('episodes_total', $data) && null !== $data['episodes_total']) {
                $animeUserupdatesdataItem->setEpisodesTotal($data['episodes_total']);
                unset($data['episodes_total']);
            } elseif (\array_key_exists('episodes_total', $data) && null === $data['episodes_total']) {
                $animeUserupdatesdataItem->setEpisodesTotal(null);
            }

            if (\array_key_exists('date', $data)) {
                $animeUserupdatesdataItem->setDate($data['date']);
                unset($data['date']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $animeUserupdatesdataItem[$key] = $value;
                }
            }

            return $animeUserupdatesdataItem;
        }

        /**
         * @param null|mixed $format
         *
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('user') && null !== $object->getUser()) {
                $data['user'] = $this->normalizer->normalize($object->getUser(), 'json', $context);
            }

            if ($object->isInitialized('score') && null !== $object->getScore()) {
                $data['score'] = $object->getScore();
            }

            if ($object->isInitialized('status') && null !== $object->getStatus()) {
                $data['status'] = $object->getStatus();
            }

            if ($object->isInitialized('episodesSeen') && null !== $object->getEpisodesSeen()) {
                $data['episodes_seen'] = $object->getEpisodesSeen();
            }

            if ($object->isInitialized('episodesTotal') && null !== $object->getEpisodesTotal()) {
                $data['episodes_total'] = $object->getEpisodesTotal();
            }

            if ($object->isInitialized('date') && null !== $object->getDate()) {
                $data['date'] = $object->getDate();
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
            return [AnimeUserupdatesdataItem::class => false];
        }
    }
}
