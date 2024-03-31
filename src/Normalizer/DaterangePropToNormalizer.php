<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\DaterangePropTo;
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
    class DaterangePropToNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return DaterangePropTo::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof DaterangePropTo;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $daterangePropTo = new DaterangePropTo();
            if (null === $data || !\is_array($data)) {
                return $daterangePropTo;
            }

            if (\array_key_exists('day', $data) && null !== $data['day']) {
                $daterangePropTo->setDay($data['day']);
                unset($data['day']);
            } elseif (\array_key_exists('day', $data) && null === $data['day']) {
                $daterangePropTo->setDay(null);
            }

            if (\array_key_exists('month', $data) && null !== $data['month']) {
                $daterangePropTo->setMonth($data['month']);
                unset($data['month']);
            } elseif (\array_key_exists('month', $data) && null === $data['month']) {
                $daterangePropTo->setMonth(null);
            }

            if (\array_key_exists('year', $data) && null !== $data['year']) {
                $daterangePropTo->setYear($data['year']);
                unset($data['year']);
            } elseif (\array_key_exists('year', $data) && null === $data['year']) {
                $daterangePropTo->setYear(null);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $daterangePropTo[$key] = $value;
                }
            }

            return $daterangePropTo;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('day') && null !== $object->getDay()) {
                $data['day'] = $object->getDay();
            }

            if ($object->isInitialized('month') && null !== $object->getMonth()) {
                $data['month'] = $object->getMonth();
            }

            if ($object->isInitialized('year') && null !== $object->getYear()) {
                $data['year'] = $object->getYear();
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
            return [DaterangePropTo::class => false];
        }
    }
} else {
    class DaterangePropToNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return DaterangePropTo::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof DaterangePropTo;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|DaterangePropTo
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $daterangePropTo = new DaterangePropTo();
            if (null === $data || !\is_array($data)) {
                return $daterangePropTo;
            }

            if (\array_key_exists('day', $data) && null !== $data['day']) {
                $daterangePropTo->setDay($data['day']);
                unset($data['day']);
            } elseif (\array_key_exists('day', $data) && null === $data['day']) {
                $daterangePropTo->setDay(null);
            }

            if (\array_key_exists('month', $data) && null !== $data['month']) {
                $daterangePropTo->setMonth($data['month']);
                unset($data['month']);
            } elseif (\array_key_exists('month', $data) && null === $data['month']) {
                $daterangePropTo->setMonth(null);
            }

            if (\array_key_exists('year', $data) && null !== $data['year']) {
                $daterangePropTo->setYear($data['year']);
                unset($data['year']);
            } elseif (\array_key_exists('year', $data) && null === $data['year']) {
                $daterangePropTo->setYear(null);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $daterangePropTo[$key] = $value;
                }
            }

            return $daterangePropTo;
        }

        /**
         * @param null|mixed $format
         *
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('day') && null !== $object->getDay()) {
                $data['day'] = $object->getDay();
            }

            if ($object->isInitialized('month') && null !== $object->getMonth()) {
                $data['month'] = $object->getMonth();
            }

            if ($object->isInitialized('year') && null !== $object->getYear()) {
                $data['year'] = $object->getYear();
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
            return [DaterangePropTo::class => false];
        }
    }
}
