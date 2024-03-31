<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\Club;
use Jikan\JikanPHP\Model\CommonImages;
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
    class ClubNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return Club::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof Club;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $club = new Club();
            if (null === $data || !\is_array($data)) {
                return $club;
            }

            if (\array_key_exists('mal_id', $data)) {
                $club->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('name', $data)) {
                $club->setName($data['name']);
                unset($data['name']);
            }

            if (\array_key_exists('url', $data)) {
                $club->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('images', $data)) {
                $club->setImages($this->denormalizer->denormalize($data['images'], CommonImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('members', $data)) {
                $club->setMembers($data['members']);
                unset($data['members']);
            }

            if (\array_key_exists('category', $data)) {
                $club->setCategory($data['category']);
                unset($data['category']);
            }

            if (\array_key_exists('created', $data)) {
                $club->setCreated($data['created']);
                unset($data['created']);
            }

            if (\array_key_exists('access', $data)) {
                $club->setAccess($data['access']);
                unset($data['access']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $club[$key] = $value;
                }
            }

            return $club;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('malId') && null !== $object->getMalId()) {
                $data['mal_id'] = $object->getMalId();
            }

            if ($object->isInitialized('name') && null !== $object->getName()) {
                $data['name'] = $object->getName();
            }

            if ($object->isInitialized('url') && null !== $object->getUrl()) {
                $data['url'] = $object->getUrl();
            }

            if ($object->isInitialized('images') && null !== $object->getImages()) {
                $data['images'] = $this->normalizer->normalize($object->getImages(), 'json', $context);
            }

            if ($object->isInitialized('members') && null !== $object->getMembers()) {
                $data['members'] = $object->getMembers();
            }

            if ($object->isInitialized('category') && null !== $object->getCategory()) {
                $data['category'] = $object->getCategory();
            }

            if ($object->isInitialized('created') && null !== $object->getCreated()) {
                $data['created'] = $object->getCreated();
            }

            if ($object->isInitialized('access') && null !== $object->getAccess()) {
                $data['access'] = $object->getAccess();
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
            return [Club::class => false];
        }
    }
} else {
    class ClubNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return Club::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof Club;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|Club
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $club = new Club();
            if (null === $data || !\is_array($data)) {
                return $club;
            }

            if (\array_key_exists('mal_id', $data)) {
                $club->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('name', $data)) {
                $club->setName($data['name']);
                unset($data['name']);
            }

            if (\array_key_exists('url', $data)) {
                $club->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('images', $data)) {
                $club->setImages($this->denormalizer->denormalize($data['images'], CommonImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('members', $data)) {
                $club->setMembers($data['members']);
                unset($data['members']);
            }

            if (\array_key_exists('category', $data)) {
                $club->setCategory($data['category']);
                unset($data['category']);
            }

            if (\array_key_exists('created', $data)) {
                $club->setCreated($data['created']);
                unset($data['created']);
            }

            if (\array_key_exists('access', $data)) {
                $club->setAccess($data['access']);
                unset($data['access']);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $club[$key] = $value;
                }
            }

            return $club;
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

            if ($object->isInitialized('name') && null !== $object->getName()) {
                $data['name'] = $object->getName();
            }

            if ($object->isInitialized('url') && null !== $object->getUrl()) {
                $data['url'] = $object->getUrl();
            }

            if ($object->isInitialized('images') && null !== $object->getImages()) {
                $data['images'] = $this->normalizer->normalize($object->getImages(), 'json', $context);
            }

            if ($object->isInitialized('members') && null !== $object->getMembers()) {
                $data['members'] = $object->getMembers();
            }

            if ($object->isInitialized('category') && null !== $object->getCategory()) {
                $data['category'] = $object->getCategory();
            }

            if ($object->isInitialized('created') && null !== $object->getCreated()) {
                $data['created'] = $object->getCreated();
            }

            if ($object->isInitialized('access') && null !== $object->getAccess()) {
                $data['access'] = $object->getAccess();
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
            return [Club::class => false];
        }
    }
}
