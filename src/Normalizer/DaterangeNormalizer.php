<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\Daterange;
use Jikan\JikanPHP\Model\DaterangeProp;
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
    class DaterangeNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return Daterange::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof Daterange;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $daterange = new Daterange();
            if (null === $data || !\is_array($data)) {
                return $daterange;
            }

            if (\array_key_exists('from', $data) && null !== $data['from']) {
                $daterange->setFrom($data['from']);
                unset($data['from']);
            } elseif (\array_key_exists('from', $data) && null === $data['from']) {
                $daterange->setFrom(null);
            }

            if (\array_key_exists('to', $data) && null !== $data['to']) {
                $daterange->setTo($data['to']);
                unset($data['to']);
            } elseif (\array_key_exists('to', $data) && null === $data['to']) {
                $daterange->setTo(null);
            }

            if (\array_key_exists('prop', $data)) {
                $daterange->setProp($this->denormalizer->denormalize($data['prop'], DaterangeProp::class, 'json', $context));
                unset($data['prop']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $daterange[$key] = $value;
                }
            }

            return $daterange;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('from') && null !== $object->getFrom()) {
                $data['from'] = $object->getFrom();
            }

            if ($object->isInitialized('to') && null !== $object->getTo()) {
                $data['to'] = $object->getTo();
            }

            if ($object->isInitialized('prop') && null !== $object->getProp()) {
                $data['prop'] = $this->normalizer->normalize($object->getProp(), 'json', $context);
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
            return [Daterange::class => false];
        }
    }
} else {
    class DaterangeNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return Daterange::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof Daterange;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|Daterange
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $daterange = new Daterange();
            if (null === $data || !\is_array($data)) {
                return $daterange;
            }

            if (\array_key_exists('from', $data) && null !== $data['from']) {
                $daterange->setFrom($data['from']);
                unset($data['from']);
            } elseif (\array_key_exists('from', $data) && null === $data['from']) {
                $daterange->setFrom(null);
            }

            if (\array_key_exists('to', $data) && null !== $data['to']) {
                $daterange->setTo($data['to']);
                unset($data['to']);
            } elseif (\array_key_exists('to', $data) && null === $data['to']) {
                $daterange->setTo(null);
            }

            if (\array_key_exists('prop', $data)) {
                $daterange->setProp($this->denormalizer->denormalize($data['prop'], DaterangeProp::class, 'json', $context));
                unset($data['prop']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $daterange[$key] = $value;
                }
            }

            return $daterange;
        }

        /**
         * @param null|mixed $format
         *
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('from') && null !== $object->getFrom()) {
                $data['from'] = $object->getFrom();
            }

            if ($object->isInitialized('to') && null !== $object->getTo()) {
                $data['to'] = $object->getTo();
            }

            if ($object->isInitialized('prop') && null !== $object->getProp()) {
                $data['prop'] = $this->normalizer->normalize($object->getProp(), 'json', $context);
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
            return [Daterange::class => false];
        }
    }
}
