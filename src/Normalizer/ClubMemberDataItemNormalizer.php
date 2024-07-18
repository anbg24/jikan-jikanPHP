<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\ClubMemberDataItem;
use Jikan\JikanPHP\Model\UserImages;
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
    class ClubMemberDataItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return ClubMemberDataItem::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof ClubMemberDataItem;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $clubMemberDataItem = new ClubMemberDataItem();
            if (null === $data || !\is_array($data)) {
                return $clubMemberDataItem;
            }

            if (\array_key_exists('username', $data)) {
                $clubMemberDataItem->setUsername($data['username']);
                unset($data['username']);
            }

            if (\array_key_exists('url', $data)) {
                $clubMemberDataItem->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('images', $data)) {
                $clubMemberDataItem->setImages($this->denormalizer->denormalize($data['images'], UserImages::class, 'json', $context));
                unset($data['images']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $clubMemberDataItem[$key] = $value;
                }
            }

            return $clubMemberDataItem;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('username') && null !== $object->getUsername()) {
                $data['username'] = $object->getUsername();
            }

            if ($object->isInitialized('url') && null !== $object->getUrl()) {
                $data['url'] = $object->getUrl();
            }

            if ($object->isInitialized('images') && null !== $object->getImages()) {
                $data['images'] = $this->normalizer->normalize($object->getImages(), 'json', $context);
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
            return [ClubMemberDataItem::class => false];
        }
    }
} else {
    class ClubMemberDataItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return ClubMemberDataItem::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof ClubMemberDataItem;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|ClubMemberDataItem
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $clubMemberDataItem = new ClubMemberDataItem();
            if (null === $data || !\is_array($data)) {
                return $clubMemberDataItem;
            }

            if (\array_key_exists('username', $data)) {
                $clubMemberDataItem->setUsername($data['username']);
                unset($data['username']);
            }

            if (\array_key_exists('url', $data)) {
                $clubMemberDataItem->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('images', $data)) {
                $clubMemberDataItem->setImages($this->denormalizer->denormalize($data['images'], UserImages::class, 'json', $context));
                unset($data['images']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $clubMemberDataItem[$key] = $value;
                }
            }

            return $clubMemberDataItem;
        }

        /**
         * @param null|mixed $format
         *
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('username') && null !== $object->getUsername()) {
                $data['username'] = $object->getUsername();
            }

            if ($object->isInitialized('url') && null !== $object->getUrl()) {
                $data['url'] = $object->getUrl();
            }

            if ($object->isInitialized('images') && null !== $object->getImages()) {
                $data['images'] = $this->normalizer->normalize($object->getImages(), 'json', $context);
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
            return [ClubMemberDataItem::class => false];
        }
    }
}