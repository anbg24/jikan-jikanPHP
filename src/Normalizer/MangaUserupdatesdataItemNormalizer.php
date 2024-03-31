<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\MangaUserupdatesdataItem;
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
    class MangaUserupdatesdataItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return MangaUserupdatesdataItem::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof MangaUserupdatesdataItem;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $mangaUserupdatesdataItem = new MangaUserupdatesdataItem();
            if (null === $data || !\is_array($data)) {
                return $mangaUserupdatesdataItem;
            }

            if (\array_key_exists('user', $data)) {
                $mangaUserupdatesdataItem->setUser($this->denormalizer->denormalize($data['user'], UserMeta::class, 'json', $context));
                unset($data['user']);
            }

            if (\array_key_exists('score', $data) && null !== $data['score']) {
                $mangaUserupdatesdataItem->setScore($data['score']);
                unset($data['score']);
            } elseif (\array_key_exists('score', $data) && null === $data['score']) {
                $mangaUserupdatesdataItem->setScore(null);
            }

            if (\array_key_exists('status', $data)) {
                $mangaUserupdatesdataItem->setStatus($data['status']);
                unset($data['status']);
            }

            if (\array_key_exists('volumes_read', $data)) {
                $mangaUserupdatesdataItem->setVolumesRead($data['volumes_read']);
                unset($data['volumes_read']);
            }

            if (\array_key_exists('volumes_total', $data)) {
                $mangaUserupdatesdataItem->setVolumesTotal($data['volumes_total']);
                unset($data['volumes_total']);
            }

            if (\array_key_exists('chapters_read', $data)) {
                $mangaUserupdatesdataItem->setChaptersRead($data['chapters_read']);
                unset($data['chapters_read']);
            }

            if (\array_key_exists('chapters_total', $data)) {
                $mangaUserupdatesdataItem->setChaptersTotal($data['chapters_total']);
                unset($data['chapters_total']);
            }

            if (\array_key_exists('date', $data)) {
                $mangaUserupdatesdataItem->setDate($data['date']);
                unset($data['date']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $mangaUserupdatesdataItem[$key] = $value;
                }
            }

            return $mangaUserupdatesdataItem;
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

            if ($object->isInitialized('volumesRead') && null !== $object->getVolumesRead()) {
                $data['volumes_read'] = $object->getVolumesRead();
            }

            if ($object->isInitialized('volumesTotal') && null !== $object->getVolumesTotal()) {
                $data['volumes_total'] = $object->getVolumesTotal();
            }

            if ($object->isInitialized('chaptersRead') && null !== $object->getChaptersRead()) {
                $data['chapters_read'] = $object->getChaptersRead();
            }

            if ($object->isInitialized('chaptersTotal') && null !== $object->getChaptersTotal()) {
                $data['chapters_total'] = $object->getChaptersTotal();
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
            return [MangaUserupdatesdataItem::class => false];
        }
    }
} else {
    class MangaUserupdatesdataItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return MangaUserupdatesdataItem::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof MangaUserupdatesdataItem;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|MangaUserupdatesdataItem
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $mangaUserupdatesdataItem = new MangaUserupdatesdataItem();
            if (null === $data || !\is_array($data)) {
                return $mangaUserupdatesdataItem;
            }

            if (\array_key_exists('user', $data)) {
                $mangaUserupdatesdataItem->setUser($this->denormalizer->denormalize($data['user'], UserMeta::class, 'json', $context));
                unset($data['user']);
            }

            if (\array_key_exists('score', $data) && null !== $data['score']) {
                $mangaUserupdatesdataItem->setScore($data['score']);
                unset($data['score']);
            } elseif (\array_key_exists('score', $data) && null === $data['score']) {
                $mangaUserupdatesdataItem->setScore(null);
            }

            if (\array_key_exists('status', $data)) {
                $mangaUserupdatesdataItem->setStatus($data['status']);
                unset($data['status']);
            }

            if (\array_key_exists('volumes_read', $data)) {
                $mangaUserupdatesdataItem->setVolumesRead($data['volumes_read']);
                unset($data['volumes_read']);
            }

            if (\array_key_exists('volumes_total', $data)) {
                $mangaUserupdatesdataItem->setVolumesTotal($data['volumes_total']);
                unset($data['volumes_total']);
            }

            if (\array_key_exists('chapters_read', $data)) {
                $mangaUserupdatesdataItem->setChaptersRead($data['chapters_read']);
                unset($data['chapters_read']);
            }

            if (\array_key_exists('chapters_total', $data)) {
                $mangaUserupdatesdataItem->setChaptersTotal($data['chapters_total']);
                unset($data['chapters_total']);
            }

            if (\array_key_exists('date', $data)) {
                $mangaUserupdatesdataItem->setDate($data['date']);
                unset($data['date']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $mangaUserupdatesdataItem[$key] = $value;
                }
            }

            return $mangaUserupdatesdataItem;
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

            if ($object->isInitialized('volumesRead') && null !== $object->getVolumesRead()) {
                $data['volumes_read'] = $object->getVolumesRead();
            }

            if ($object->isInitialized('volumesTotal') && null !== $object->getVolumesTotal()) {
                $data['volumes_total'] = $object->getVolumesTotal();
            }

            if ($object->isInitialized('chaptersRead') && null !== $object->getChaptersRead()) {
                $data['chapters_read'] = $object->getChaptersRead();
            }

            if ($object->isInitialized('chaptersTotal') && null !== $object->getChaptersTotal()) {
                $data['chapters_total'] = $object->getChaptersTotal();
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
            return [MangaUserupdatesdataItem::class => false];
        }
    }
}
