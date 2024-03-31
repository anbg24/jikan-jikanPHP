<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\CommonImages;
use Jikan\JikanPHP\Model\ProducerFull;
use Jikan\JikanPHP\Model\ProducerFullExternalItem;
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
    class ProducerFullNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return ProducerFull::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof ProducerFull;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $producerFull = new ProducerFull();
            if (null === $data || !\is_array($data)) {
                return $producerFull;
            }

            if (\array_key_exists('mal_id', $data)) {
                $producerFull->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('url', $data)) {
                $producerFull->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('titles', $data)) {
                $values = [];
                foreach ($data['titles'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, Title::class, 'json', $context);
                }

                $producerFull->setTitles($values);
                unset($data['titles']);
            }

            if (\array_key_exists('images', $data)) {
                $producerFull->setImages($this->denormalizer->denormalize($data['images'], CommonImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('favorites', $data)) {
                $producerFull->setFavorites($data['favorites']);
                unset($data['favorites']);
            }

            if (\array_key_exists('count', $data)) {
                $producerFull->setCount($data['count']);
                unset($data['count']);
            }

            if (\array_key_exists('established', $data) && null !== $data['established']) {
                $producerFull->setEstablished($data['established']);
                unset($data['established']);
            } elseif (\array_key_exists('established', $data) && null === $data['established']) {
                $producerFull->setEstablished(null);
            }

            if (\array_key_exists('about', $data) && null !== $data['about']) {
                $producerFull->setAbout($data['about']);
                unset($data['about']);
            } elseif (\array_key_exists('about', $data) && null === $data['about']) {
                $producerFull->setAbout(null);
            }

            if (\array_key_exists('external', $data)) {
                $values_1 = [];
                foreach ($data['external'] as $value_1) {
                    $values_1[] = $this->denormalizer->denormalize($value_1, ProducerFullExternalItem::class, 'json', $context);
                }

                $producerFull->setExternal($values_1);
                unset($data['external']);
            }

            foreach ($data as $key => $value_2) {
                if (preg_match('#.*#', (string) $key)) {
                    $producerFull[$key] = $value_2;
                }
            }

            return $producerFull;
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

            if ($object->isInitialized('external') && null !== $object->getExternal()) {
                $values_1 = [];
                foreach ($object->getExternal() as $value_1) {
                    $values_1[] = $this->normalizer->normalize($value_1, 'json', $context);
                }

                $data['external'] = $values_1;
            }

            foreach ($object as $key => $value_2) {
                if (preg_match('#.*#', (string) $key)) {
                    $data[$key] = $value_2;
                }
            }

            return $data;
        }

        public function getSupportedTypes(?string $format = null): array
        {
            return [ProducerFull::class => false];
        }
    }
} else {
    class ProducerFullNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return ProducerFull::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof ProducerFull;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|ProducerFull
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $producerFull = new ProducerFull();
            if (null === $data || !\is_array($data)) {
                return $producerFull;
            }

            if (\array_key_exists('mal_id', $data)) {
                $producerFull->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('url', $data)) {
                $producerFull->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('titles', $data)) {
                $values = [];
                foreach ($data['titles'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, Title::class, 'json', $context);
                }

                $producerFull->setTitles($values);
                unset($data['titles']);
            }

            if (\array_key_exists('images', $data)) {
                $producerFull->setImages($this->denormalizer->denormalize($data['images'], CommonImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('favorites', $data)) {
                $producerFull->setFavorites($data['favorites']);
                unset($data['favorites']);
            }

            if (\array_key_exists('count', $data)) {
                $producerFull->setCount($data['count']);
                unset($data['count']);
            }

            if (\array_key_exists('established', $data) && null !== $data['established']) {
                $producerFull->setEstablished($data['established']);
                unset($data['established']);
            } elseif (\array_key_exists('established', $data) && null === $data['established']) {
                $producerFull->setEstablished(null);
            }

            if (\array_key_exists('about', $data) && null !== $data['about']) {
                $producerFull->setAbout($data['about']);
                unset($data['about']);
            } elseif (\array_key_exists('about', $data) && null === $data['about']) {
                $producerFull->setAbout(null);
            }

            if (\array_key_exists('external', $data)) {
                $values_1 = [];
                foreach ($data['external'] as $value_1) {
                    $values_1[] = $this->denormalizer->denormalize($value_1, ProducerFullExternalItem::class, 'json', $context);
                }

                $producerFull->setExternal($values_1);
                unset($data['external']);
            }

            foreach ($data as $key => $value_2) {
                if (preg_match('#.*#', (string) $key)) {
                    $producerFull[$key] = $value_2;
                }
            }

            return $producerFull;
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

            if ($object->isInitialized('external') && null !== $object->getExternal()) {
                $values_1 = [];
                foreach ($object->getExternal() as $value_1) {
                    $values_1[] = $this->normalizer->normalize($value_1, 'json', $context);
                }

                $data['external'] = $values_1;
            }

            foreach ($object as $key => $value_2) {
                if (preg_match('#.*#', (string) $key)) {
                    $data[$key] = $value_2;
                }
            }

            return $data;
        }

        public function getSupportedTypes(?string $format = null): array
        {
            return [ProducerFull::class => false];
        }
    }
}
