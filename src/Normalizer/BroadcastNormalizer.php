<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\Broadcast;
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
    class BroadcastNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return Broadcast::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof Broadcast;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $broadcast = new Broadcast();
            if (null === $data || !\is_array($data)) {
                return $broadcast;
            }

            if (\array_key_exists('day', $data) && null !== $data['day']) {
                $broadcast->setDay($data['day']);
                unset($data['day']);
            } elseif (\array_key_exists('day', $data) && null === $data['day']) {
                $broadcast->setDay(null);
            }

            if (\array_key_exists('time', $data) && null !== $data['time']) {
                $broadcast->setTime($data['time']);
                unset($data['time']);
            } elseif (\array_key_exists('time', $data) && null === $data['time']) {
                $broadcast->setTime(null);
            }

            if (\array_key_exists('timezone', $data) && null !== $data['timezone']) {
                $broadcast->setTimezone($data['timezone']);
                unset($data['timezone']);
            } elseif (\array_key_exists('timezone', $data) && null === $data['timezone']) {
                $broadcast->setTimezone(null);
            }

            if (\array_key_exists('string', $data) && null !== $data['string']) {
                $broadcast->setString($data['string']);
                unset($data['string']);
            } elseif (\array_key_exists('string', $data) && null === $data['string']) {
                $broadcast->setString(null);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $broadcast[$key] = $value;
                }
            }

            return $broadcast;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('day') && null !== $object->getDay()) {
                $data['day'] = $object->getDay();
            }

            if ($object->isInitialized('time') && null !== $object->getTime()) {
                $data['time'] = $object->getTime();
            }

            if ($object->isInitialized('timezone') && null !== $object->getTimezone()) {
                $data['timezone'] = $object->getTimezone();
            }

            if ($object->isInitialized('string') && null !== $object->getString()) {
                $data['string'] = $object->getString();
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
            return [Broadcast::class => false];
        }
    }
} else {
    class BroadcastNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return Broadcast::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof Broadcast;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|Broadcast
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $broadcast = new Broadcast();
            if (null === $data || !\is_array($data)) {
                return $broadcast;
            }

            if (\array_key_exists('day', $data) && null !== $data['day']) {
                $broadcast->setDay($data['day']);
                unset($data['day']);
            } elseif (\array_key_exists('day', $data) && null === $data['day']) {
                $broadcast->setDay(null);
            }

            if (\array_key_exists('time', $data) && null !== $data['time']) {
                $broadcast->setTime($data['time']);
                unset($data['time']);
            } elseif (\array_key_exists('time', $data) && null === $data['time']) {
                $broadcast->setTime(null);
            }

            if (\array_key_exists('timezone', $data) && null !== $data['timezone']) {
                $broadcast->setTimezone($data['timezone']);
                unset($data['timezone']);
            } elseif (\array_key_exists('timezone', $data) && null === $data['timezone']) {
                $broadcast->setTimezone(null);
            }

            if (\array_key_exists('string', $data) && null !== $data['string']) {
                $broadcast->setString($data['string']);
                unset($data['string']);
            } elseif (\array_key_exists('string', $data) && null === $data['string']) {
                $broadcast->setString(null);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $broadcast[$key] = $value;
                }
            }

            return $broadcast;
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

            if ($object->isInitialized('time') && null !== $object->getTime()) {
                $data['time'] = $object->getTime();
            }

            if ($object->isInitialized('timezone') && null !== $object->getTimezone()) {
                $data['timezone'] = $object->getTimezone();
            }

            if ($object->isInitialized('string') && null !== $object->getString()) {
                $data['string'] = $object->getString();
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
            return [Broadcast::class => false];
        }
    }
}
