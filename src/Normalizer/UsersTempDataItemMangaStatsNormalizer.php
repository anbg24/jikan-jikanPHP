<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
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
    class UsersTempDataItemMangaStatsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return UsersTempDataItemMangaStats::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof UsersTempDataItemMangaStats;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $usersTempDataItemMangaStats = new UsersTempDataItemMangaStats();
            if (\array_key_exists('days_read', $data) && \is_int($data['days_read'])) {
                $data['days_read'] = (float) $data['days_read'];
            }

            if (\array_key_exists('mean_score', $data) && \is_int($data['mean_score'])) {
                $data['mean_score'] = (float) $data['mean_score'];
            }

            if (null === $data || !\is_array($data)) {
                return $usersTempDataItemMangaStats;
            }

            if (\array_key_exists('days_read', $data)) {
                $usersTempDataItemMangaStats->setDaysRead($data['days_read']);
                unset($data['days_read']);
            }

            if (\array_key_exists('mean_score', $data)) {
                $usersTempDataItemMangaStats->setMeanScore($data['mean_score']);
                unset($data['mean_score']);
            }

            if (\array_key_exists('reading', $data)) {
                $usersTempDataItemMangaStats->setReading($data['reading']);
                unset($data['reading']);
            }

            if (\array_key_exists('completed', $data)) {
                $usersTempDataItemMangaStats->setCompleted($data['completed']);
                unset($data['completed']);
            }

            if (\array_key_exists('on_hold', $data)) {
                $usersTempDataItemMangaStats->setOnHold($data['on_hold']);
                unset($data['on_hold']);
            }

            if (\array_key_exists('dropped', $data)) {
                $usersTempDataItemMangaStats->setDropped($data['dropped']);
                unset($data['dropped']);
            }

            if (\array_key_exists('plan_to_read', $data)) {
                $usersTempDataItemMangaStats->setPlanToRead($data['plan_to_read']);
                unset($data['plan_to_read']);
            }

            if (\array_key_exists('total_entries', $data)) {
                $usersTempDataItemMangaStats->setTotalEntries($data['total_entries']);
                unset($data['total_entries']);
            }

            if (\array_key_exists('reread', $data)) {
                $usersTempDataItemMangaStats->setReread($data['reread']);
                unset($data['reread']);
            }

            if (\array_key_exists('chapters_read', $data)) {
                $usersTempDataItemMangaStats->setChaptersRead($data['chapters_read']);
                unset($data['chapters_read']);
            }

            if (\array_key_exists('volumes_read', $data)) {
                $usersTempDataItemMangaStats->setVolumesRead($data['volumes_read']);
                unset($data['volumes_read']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $usersTempDataItemMangaStats[$key] = $value;
                }
            }

            return $usersTempDataItemMangaStats;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('daysRead') && null !== $object->getDaysRead()) {
                $data['days_read'] = $object->getDaysRead();
            }

            if ($object->isInitialized('meanScore') && null !== $object->getMeanScore()) {
                $data['mean_score'] = $object->getMeanScore();
            }

            if ($object->isInitialized('reading') && null !== $object->getReading()) {
                $data['reading'] = $object->getReading();
            }

            if ($object->isInitialized('completed') && null !== $object->getCompleted()) {
                $data['completed'] = $object->getCompleted();
            }

            if ($object->isInitialized('onHold') && null !== $object->getOnHold()) {
                $data['on_hold'] = $object->getOnHold();
            }

            if ($object->isInitialized('dropped') && null !== $object->getDropped()) {
                $data['dropped'] = $object->getDropped();
            }

            if ($object->isInitialized('planToRead') && null !== $object->getPlanToRead()) {
                $data['plan_to_read'] = $object->getPlanToRead();
            }

            if ($object->isInitialized('totalEntries') && null !== $object->getTotalEntries()) {
                $data['total_entries'] = $object->getTotalEntries();
            }

            if ($object->isInitialized('reread') && null !== $object->getReread()) {
                $data['reread'] = $object->getReread();
            }

            if ($object->isInitialized('chaptersRead') && null !== $object->getChaptersRead()) {
                $data['chapters_read'] = $object->getChaptersRead();
            }

            if ($object->isInitialized('volumesRead') && null !== $object->getVolumesRead()) {
                $data['volumes_read'] = $object->getVolumesRead();
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
            return [UsersTempDataItemMangaStats::class => false];
        }
    }
} else {
    class UsersTempDataItemMangaStatsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return UsersTempDataItemMangaStats::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof UsersTempDataItemMangaStats;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|UsersTempDataItemMangaStats
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $usersTempDataItemMangaStats = new UsersTempDataItemMangaStats();
            if (\array_key_exists('days_read', $data) && \is_int($data['days_read'])) {
                $data['days_read'] = (float) $data['days_read'];
            }

            if (\array_key_exists('mean_score', $data) && \is_int($data['mean_score'])) {
                $data['mean_score'] = (float) $data['mean_score'];
            }

            if (null === $data || !\is_array($data)) {
                return $usersTempDataItemMangaStats;
            }

            if (\array_key_exists('days_read', $data)) {
                $usersTempDataItemMangaStats->setDaysRead($data['days_read']);
                unset($data['days_read']);
            }

            if (\array_key_exists('mean_score', $data)) {
                $usersTempDataItemMangaStats->setMeanScore($data['mean_score']);
                unset($data['mean_score']);
            }

            if (\array_key_exists('reading', $data)) {
                $usersTempDataItemMangaStats->setReading($data['reading']);
                unset($data['reading']);
            }

            if (\array_key_exists('completed', $data)) {
                $usersTempDataItemMangaStats->setCompleted($data['completed']);
                unset($data['completed']);
            }

            if (\array_key_exists('on_hold', $data)) {
                $usersTempDataItemMangaStats->setOnHold($data['on_hold']);
                unset($data['on_hold']);
            }

            if (\array_key_exists('dropped', $data)) {
                $usersTempDataItemMangaStats->setDropped($data['dropped']);
                unset($data['dropped']);
            }

            if (\array_key_exists('plan_to_read', $data)) {
                $usersTempDataItemMangaStats->setPlanToRead($data['plan_to_read']);
                unset($data['plan_to_read']);
            }

            if (\array_key_exists('total_entries', $data)) {
                $usersTempDataItemMangaStats->setTotalEntries($data['total_entries']);
                unset($data['total_entries']);
            }

            if (\array_key_exists('reread', $data)) {
                $usersTempDataItemMangaStats->setReread($data['reread']);
                unset($data['reread']);
            }

            if (\array_key_exists('chapters_read', $data)) {
                $usersTempDataItemMangaStats->setChaptersRead($data['chapters_read']);
                unset($data['chapters_read']);
            }

            if (\array_key_exists('volumes_read', $data)) {
                $usersTempDataItemMangaStats->setVolumesRead($data['volumes_read']);
                unset($data['volumes_read']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $usersTempDataItemMangaStats[$key] = $value;
                }
            }

            return $usersTempDataItemMangaStats;
        }

        /**
         * @param null|mixed $format
         *
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('daysRead') && null !== $object->getDaysRead()) {
                $data['days_read'] = $object->getDaysRead();
            }

            if ($object->isInitialized('meanScore') && null !== $object->getMeanScore()) {
                $data['mean_score'] = $object->getMeanScore();
            }

            if ($object->isInitialized('reading') && null !== $object->getReading()) {
                $data['reading'] = $object->getReading();
            }

            if ($object->isInitialized('completed') && null !== $object->getCompleted()) {
                $data['completed'] = $object->getCompleted();
            }

            if ($object->isInitialized('onHold') && null !== $object->getOnHold()) {
                $data['on_hold'] = $object->getOnHold();
            }

            if ($object->isInitialized('dropped') && null !== $object->getDropped()) {
                $data['dropped'] = $object->getDropped();
            }

            if ($object->isInitialized('planToRead') && null !== $object->getPlanToRead()) {
                $data['plan_to_read'] = $object->getPlanToRead();
            }

            if ($object->isInitialized('totalEntries') && null !== $object->getTotalEntries()) {
                $data['total_entries'] = $object->getTotalEntries();
            }

            if ($object->isInitialized('reread') && null !== $object->getReread()) {
                $data['reread'] = $object->getReread();
            }

            if ($object->isInitialized('chaptersRead') && null !== $object->getChaptersRead()) {
                $data['chapters_read'] = $object->getChaptersRead();
            }

            if ($object->isInitialized('volumesRead') && null !== $object->getVolumesRead()) {
                $data['volumes_read'] = $object->getVolumesRead();
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
            return [UsersTempDataItemMangaStats::class => false];
        }
    }
}
