<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\CharacterVoiceActorsDataItem;
use Jikan\JikanPHP\Model\PersonMeta;
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
    class CharacterVoiceActorsDataItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return CharacterVoiceActorsDataItem::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof CharacterVoiceActorsDataItem;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $characterVoiceActorsDataItem = new CharacterVoiceActorsDataItem();
            if (null === $data || !\is_array($data)) {
                return $characterVoiceActorsDataItem;
            }

            if (\array_key_exists('language', $data)) {
                $characterVoiceActorsDataItem->setLanguage($data['language']);
                unset($data['language']);
            }

            if (\array_key_exists('person', $data)) {
                $characterVoiceActorsDataItem->setPerson($this->denormalizer->denormalize($data['person'], PersonMeta::class, 'json', $context));
                unset($data['person']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $characterVoiceActorsDataItem[$key] = $value;
                }
            }

            return $characterVoiceActorsDataItem;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('language') && null !== $object->getLanguage()) {
                $data['language'] = $object->getLanguage();
            }

            if ($object->isInitialized('person') && null !== $object->getPerson()) {
                $data['person'] = $this->normalizer->normalize($object->getPerson(), 'json', $context);
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
            return [CharacterVoiceActorsDataItem::class => false];
        }
    }
} else {
    class CharacterVoiceActorsDataItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return CharacterVoiceActorsDataItem::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof CharacterVoiceActorsDataItem;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|CharacterVoiceActorsDataItem
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $characterVoiceActorsDataItem = new CharacterVoiceActorsDataItem();
            if (null === $data || !\is_array($data)) {
                return $characterVoiceActorsDataItem;
            }

            if (\array_key_exists('language', $data)) {
                $characterVoiceActorsDataItem->setLanguage($data['language']);
                unset($data['language']);
            }

            if (\array_key_exists('person', $data)) {
                $characterVoiceActorsDataItem->setPerson($this->denormalizer->denormalize($data['person'], PersonMeta::class, 'json', $context));
                unset($data['person']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $characterVoiceActorsDataItem[$key] = $value;
                }
            }

            return $characterVoiceActorsDataItem;
        }

        /**
         * @param null|mixed $format
         *
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('language') && null !== $object->getLanguage()) {
                $data['language'] = $object->getLanguage();
            }

            if ($object->isInitialized('person') && null !== $object->getPerson()) {
                $data['person'] = $this->normalizer->normalize($object->getPerson(), 'json', $context);
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
            return [CharacterVoiceActorsDataItem::class => false];
        }
    }
}
