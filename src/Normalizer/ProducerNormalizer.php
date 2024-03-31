<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\CommonImages;
use Jikan\JikanPHP\Model\Producer;
use Jikan\JikanPHP\Model\Title;
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
    class ProducerNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return Producer::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof Producer;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $producer = new Producer();
            if (null === $data || !\is_array($data)) {
                return $producer;
            }

            if (\array_key_exists('mal_id', $data)) {
                $producer->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('url', $data)) {
                $producer->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('titles', $data)) {
                $values = [];
                foreach ($data['titles'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, Title::class, 'json', $context);
                }

                $producer->setTitles($values);
                unset($data['titles']);
            }

            if (\array_key_exists('images', $data)) {
                $producer->setImages($this->denormalizer->denormalize($data['images'], CommonImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('favorites', $data)) {
                $producer->setFavorites($data['favorites']);
                unset($data['favorites']);
            }

            if (\array_key_exists('count', $data)) {
                $producer->setCount($data['count']);
                unset($data['count']);
            }

            if (\array_key_exists('established', $data) && null !== $data['established']) {
                $producer->setEstablished($data['established']);
                unset($data['established']);
            } elseif (\array_key_exists('established', $data) && null === $data['established']) {
                $producer->setEstablished(null);
            }

            if (\array_key_exists('about', $data) && null !== $data['about']) {
                $producer->setAbout($data['about']);
                unset($data['about']);
            } elseif (\array_key_exists('about', $data) && null === $data['about']) {
                $producer->setAbout(null);
            }

            foreach ($data as $key => $value_1) {
                if (preg_match('#.*#', (string) $key)) {
                    $producer[$key] = $value_1;
                }
            }

            return $producer;
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

            if ($object->isInitialized('titles') && null !== $object->getTitles()) {
                $values = [];
                foreach ($object->getTitles() as $title) {
                    $values[] = $this->normalizer->normalize($title, 'json', $context);
                }

                $data['titles'] = $values;
            }

            if ($object->isInitialized('images') && null !== $object->getImages()) {
                $data['images'] = $this->normalizer->normalize($object->getImages(), 'json', $context);
            }

            if ($object->isInitialized('favorites') && null !== $object->getFavorites()) {
                $data['favorites'] = $object->getFavorites();
            }

            if ($object->isInitialized('count') && null !== $object->getCount()) {
                $data['count'] = $object->getCount();
            }

            if ($object->isInitialized('established') && null !== $object->getEstablished()) {
                $data['established'] = $object->getEstablished();
            }

            if ($object->isInitialized('about') && null !== $object->getAbout()) {
                $data['about'] = $object->getAbout();
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
            return [Producer::class => false];
        }
    }
} else {
    class ProducerNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return Producer::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof Producer;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|Producer
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $producer = new Producer();
            if (null === $data || !\is_array($data)) {
                return $producer;
            }

            if (\array_key_exists('mal_id', $data)) {
                $producer->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('url', $data)) {
                $producer->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('titles', $data)) {
                $values = [];
                foreach ($data['titles'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, Title::class, 'json', $context);
                }

                $producer->setTitles($values);
                unset($data['titles']);
            }

            if (\array_key_exists('images', $data)) {
                $producer->setImages($this->denormalizer->denormalize($data['images'], CommonImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('favorites', $data)) {
                $producer->setFavorites($data['favorites']);
                unset($data['favorites']);
            }

            if (\array_key_exists('count', $data)) {
                $producer->setCount($data['count']);
                unset($data['count']);
            }

            if (\array_key_exists('established', $data) && null !== $data['established']) {
                $producer->setEstablished($data['established']);
                unset($data['established']);
            } elseif (\array_key_exists('established', $data) && null === $data['established']) {
                $producer->setEstablished(null);
            }

            if (\array_key_exists('about', $data) && null !== $data['about']) {
                $producer->setAbout($data['about']);
                unset($data['about']);
            } elseif (\array_key_exists('about', $data) && null === $data['about']) {
                $producer->setAbout(null);
            }

            foreach ($data as $key => $value_1) {
                if (preg_match('#.*#', (string) $key)) {
                    $producer[$key] = $value_1;
                }
            }

            return $producer;
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

            if ($object->isInitialized('titles') && null !== $object->getTitles()) {
                $values = [];
                foreach ($object->getTitles() as $title) {
                    $values[] = $this->normalizer->normalize($title, 'json', $context);
                }

                $data['titles'] = $values;
            }

            if ($object->isInitialized('images') && null !== $object->getImages()) {
                $data['images'] = $this->normalizer->normalize($object->getImages(), 'json', $context);
            }

            if ($object->isInitialized('favorites') && null !== $object->getFavorites()) {
                $data['favorites'] = $object->getFavorites();
            }

            if ($object->isInitialized('count') && null !== $object->getCount()) {
                $data['count'] = $object->getCount();
            }

            if ($object->isInitialized('established') && null !== $object->getEstablished()) {
                $data['established'] = $object->getEstablished();
            }

            if ($object->isInitialized('about') && null !== $object->getAbout()) {
                $data['about'] = $object->getAbout();
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
            return [Producer::class => false];
        }
    }
}
