<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\AnimeStaffDataItemPerson;
use Jikan\JikanPHP\Model\PeopleImages;
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
    class AnimeStaffDataItemPersonNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return AnimeStaffDataItemPerson::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof AnimeStaffDataItemPerson;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $animeStaffDataItemPerson = new AnimeStaffDataItemPerson();
            if (null === $data || !\is_array($data)) {
                return $animeStaffDataItemPerson;
            }

            if (\array_key_exists('mal_id', $data)) {
                $animeStaffDataItemPerson->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('url', $data)) {
                $animeStaffDataItemPerson->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('images', $data)) {
                $animeStaffDataItemPerson->setImages($this->denormalizer->denormalize($data['images'], PeopleImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('name', $data)) {
                $animeStaffDataItemPerson->setName($data['name']);
                unset($data['name']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $animeStaffDataItemPerson[$key] = $value;
                }
            }

            return $animeStaffDataItemPerson;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('malId') && null !== $object->getMalId()) {
                $data['mal_id'] = $object->getMalId();
            }

            if ($object->isInitialized('url') && null !== $object->getUrl()) {
                $data['url'] = $object->getUrl();
            }

            if ($object->isInitialized('images') && null !== $object->getImages()) {
                $data['images'] = $this->normalizer->normalize($object->getImages(), 'json', $context);
            }

            if ($object->isInitialized('name') && null !== $object->getName()) {
                $data['name'] = $object->getName();
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
            return [AnimeStaffDataItemPerson::class => false];
        }
    }
} else {
    class AnimeStaffDataItemPersonNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return AnimeStaffDataItemPerson::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof AnimeStaffDataItemPerson;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|AnimeStaffDataItemPerson
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $animeStaffDataItemPerson = new AnimeStaffDataItemPerson();
            if (null === $data || !\is_array($data)) {
                return $animeStaffDataItemPerson;
            }

            if (\array_key_exists('mal_id', $data)) {
                $animeStaffDataItemPerson->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('url', $data)) {
                $animeStaffDataItemPerson->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('images', $data)) {
                $animeStaffDataItemPerson->setImages($this->denormalizer->denormalize($data['images'], PeopleImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('name', $data)) {
                $animeStaffDataItemPerson->setName($data['name']);
                unset($data['name']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $animeStaffDataItemPerson[$key] = $value;
                }
            }

            return $animeStaffDataItemPerson;
        }

        /**
         * @param null|mixed $format
         *
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('malId') && null !== $object->getMalId()) {
                $data['mal_id'] = $object->getMalId();
            }

            if ($object->isInitialized('url') && null !== $object->getUrl()) {
                $data['url'] = $object->getUrl();
            }

            if ($object->isInitialized('images') && null !== $object->getImages()) {
                $data['images'] = $this->normalizer->normalize($object->getImages(), 'json', $context);
            }

            if ($object->isInitialized('name') && null !== $object->getName()) {
                $data['name'] = $object->getName();
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
            return [AnimeStaffDataItemPerson::class => false];
        }
    }
}
