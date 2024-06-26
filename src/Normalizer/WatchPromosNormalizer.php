<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\PaginationPagination;
use Jikan\JikanPHP\Model\WatchPromos;
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
    class WatchPromosNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return WatchPromos::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof WatchPromos;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $watchPromos = new WatchPromos();
            if (null === $data || !\is_array($data)) {
                return $watchPromos;
            }

            if (\array_key_exists('pagination', $data)) {
                $watchPromos->setPagination($this->denormalizer->denormalize($data['pagination'], PaginationPagination::class, 'json', $context));
                unset($data['pagination']);
            }

            if (\array_key_exists('title', $data)) {
                $watchPromos->setTitle($data['title']);
                unset($data['title']);
            }

            if (\array_key_exists('data', $data)) {
                $values = [];
                foreach ($data['data'] as $value) {
                    $values[] = $value;
                }

                $watchPromos->setData($values);
                unset($data['data']);
            }

            foreach ($data as $key => $value_1) {
                if (preg_match('#.*#', (string) $key)) {
                    $watchPromos[$key] = $value_1;
                }
            }

            return $watchPromos;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('pagination') && null !== $object->getPagination()) {
                $data['pagination'] = $this->normalizer->normalize($object->getPagination(), 'json', $context);
            }

            if ($object->isInitialized('title') && null !== $object->getTitle()) {
                $data['title'] = $object->getTitle();
            }

            if ($object->isInitialized('data') && null !== $object->getData()) {
                $values = [];
                foreach ($object->getData() as $value) {
                    $values[] = $value;
                }

                $data['data'] = $values;
            }

            foreach ($object as $key => $value_1) {
                if (preg_match('#.*#', (string) $key)) {
                    $data[$key] = $value_1;
                }
            }

            return $data;
        }

        public function getSupportedTypes(?string $format = null): array
        {
            return [WatchPromos::class => false];
        }
    }
} else {
    class WatchPromosNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return WatchPromos::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof WatchPromos;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|WatchPromos
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $watchPromos = new WatchPromos();
            if (null === $data || !\is_array($data)) {
                return $watchPromos;
            }

            if (\array_key_exists('pagination', $data)) {
                $watchPromos->setPagination($this->denormalizer->denormalize($data['pagination'], PaginationPagination::class, 'json', $context));
                unset($data['pagination']);
            }

            if (\array_key_exists('title', $data)) {
                $watchPromos->setTitle($data['title']);
                unset($data['title']);
            }

            if (\array_key_exists('data', $data)) {
                $values = [];
                foreach ($data['data'] as $value) {
                    $values[] = $value;
                }

                $watchPromos->setData($values);
                unset($data['data']);
            }

            foreach ($data as $key => $value_1) {
                if (preg_match('#.*#', (string) $key)) {
                    $watchPromos[$key] = $value_1;
                }
            }

            return $watchPromos;
        }

        /**
         * @param null|mixed $format
         *
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('pagination') && null !== $object->getPagination()) {
                $data['pagination'] = $this->normalizer->normalize($object->getPagination(), 'json', $context);
            }

            if ($object->isInitialized('title') && null !== $object->getTitle()) {
                $data['title'] = $object->getTitle();
            }

            if ($object->isInitialized('data') && null !== $object->getData()) {
                $values = [];
                foreach ($object->getData() as $value) {
                    $values[] = $value;
                }

                $data['data'] = $values;
            }

            foreach ($object as $key => $value_1) {
                if (preg_match('#.*#', (string) $key)) {
                    $data[$key] = $value_1;
                }
            }

            return $data;
        }

        public function getSupportedTypes(?string $format = null): array
        {
            return [WatchPromos::class => false];
        }
    }
}
