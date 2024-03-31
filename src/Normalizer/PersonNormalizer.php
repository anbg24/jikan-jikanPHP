<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\PeopleImages;
use Jikan\JikanPHP\Model\Person;
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
    class PersonNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return Person::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof Person;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $person = new Person();
            if (null === $data || !\is_array($data)) {
                return $person;
            }

            if (\array_key_exists('mal_id', $data)) {
                $person->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('url', $data)) {
                $person->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('website_url', $data) && null !== $data['website_url']) {
                $person->setWebsiteUrl($data['website_url']);
                unset($data['website_url']);
            } elseif (\array_key_exists('website_url', $data) && null === $data['website_url']) {
                $person->setWebsiteUrl(null);
            }

            if (\array_key_exists('images', $data)) {
                $person->setImages($this->denormalizer->denormalize($data['images'], PeopleImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('name', $data)) {
                $person->setName($data['name']);
                unset($data['name']);
            }

            if (\array_key_exists('given_name', $data) && null !== $data['given_name']) {
                $person->setGivenName($data['given_name']);
                unset($data['given_name']);
            } elseif (\array_key_exists('given_name', $data) && null === $data['given_name']) {
                $person->setGivenName(null);
            }

            if (\array_key_exists('family_name', $data) && null !== $data['family_name']) {
                $person->setFamilyName($data['family_name']);
                unset($data['family_name']);
            } elseif (\array_key_exists('family_name', $data) && null === $data['family_name']) {
                $person->setFamilyName(null);
            }

            if (\array_key_exists('alternate_names', $data)) {
                $values = [];
                foreach ($data['alternate_names'] as $value) {
                    $values[] = $value;
                }

                $person->setAlternateNames($values);
                unset($data['alternate_names']);
            }

            if (\array_key_exists('birthday', $data) && null !== $data['birthday']) {
                $person->setBirthday($data['birthday']);
                unset($data['birthday']);
            } elseif (\array_key_exists('birthday', $data) && null === $data['birthday']) {
                $person->setBirthday(null);
            }

            if (\array_key_exists('favorites', $data)) {
                $person->setFavorites($data['favorites']);
                unset($data['favorites']);
            }

            if (\array_key_exists('about', $data) && null !== $data['about']) {
                $person->setAbout($data['about']);
                unset($data['about']);
            } elseif (\array_key_exists('about', $data) && null === $data['about']) {
                $person->setAbout(null);
            }

            foreach ($data as $key => $value_1) {
                if (preg_match('#.*#', (string) $key)) {
                    $person[$key] = $value_1;
                }
            }

            return $person;
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

            if ($object->isInitialized('websiteUrl') && null !== $object->getWebsiteUrl()) {
                $data['website_url'] = $object->getWebsiteUrl();
            }

            if ($object->isInitialized('images') && null !== $object->getImages()) {
                $data['images'] = $this->normalizer->normalize($object->getImages(), 'json', $context);
            }

            if ($object->isInitialized('name') && null !== $object->getName()) {
                $data['name'] = $object->getName();
            }

            if ($object->isInitialized('givenName') && null !== $object->getGivenName()) {
                $data['given_name'] = $object->getGivenName();
            }

            if ($object->isInitialized('familyName') && null !== $object->getFamilyName()) {
                $data['family_name'] = $object->getFamilyName();
            }

            if ($object->isInitialized('alternateNames') && null !== $object->getAlternateNames()) {
                $values = [];
                foreach ($object->getAlternateNames() as $alternateName) {
                    $values[] = $alternateName;
                }

                $data['alternate_names'] = $values;
            }

            if ($object->isInitialized('birthday') && null !== $object->getBirthday()) {
                $data['birthday'] = $object->getBirthday();
            }

            if ($object->isInitialized('favorites') && null !== $object->getFavorites()) {
                $data['favorites'] = $object->getFavorites();
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
            return [Person::class => false];
        }
    }
} else {
    class PersonNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return Person::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof Person;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|Person
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $person = new Person();
            if (null === $data || !\is_array($data)) {
                return $person;
            }

            if (\array_key_exists('mal_id', $data)) {
                $person->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('url', $data)) {
                $person->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('website_url', $data) && null !== $data['website_url']) {
                $person->setWebsiteUrl($data['website_url']);
                unset($data['website_url']);
            } elseif (\array_key_exists('website_url', $data) && null === $data['website_url']) {
                $person->setWebsiteUrl(null);
            }

            if (\array_key_exists('images', $data)) {
                $person->setImages($this->denormalizer->denormalize($data['images'], PeopleImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('name', $data)) {
                $person->setName($data['name']);
                unset($data['name']);
            }

            if (\array_key_exists('given_name', $data) && null !== $data['given_name']) {
                $person->setGivenName($data['given_name']);
                unset($data['given_name']);
            } elseif (\array_key_exists('given_name', $data) && null === $data['given_name']) {
                $person->setGivenName(null);
            }

            if (\array_key_exists('family_name', $data) && null !== $data['family_name']) {
                $person->setFamilyName($data['family_name']);
                unset($data['family_name']);
            } elseif (\array_key_exists('family_name', $data) && null === $data['family_name']) {
                $person->setFamilyName(null);
            }

            if (\array_key_exists('alternate_names', $data)) {
                $values = [];
                foreach ($data['alternate_names'] as $value) {
                    $values[] = $value;
                }

                $person->setAlternateNames($values);
                unset($data['alternate_names']);
            }

            if (\array_key_exists('birthday', $data) && null !== $data['birthday']) {
                $person->setBirthday($data['birthday']);
                unset($data['birthday']);
            } elseif (\array_key_exists('birthday', $data) && null === $data['birthday']) {
                $person->setBirthday(null);
            }

            if (\array_key_exists('favorites', $data)) {
                $person->setFavorites($data['favorites']);
                unset($data['favorites']);
            }

            if (\array_key_exists('about', $data) && null !== $data['about']) {
                $person->setAbout($data['about']);
                unset($data['about']);
            } elseif (\array_key_exists('about', $data) && null === $data['about']) {
                $person->setAbout(null);
            }

            foreach ($data as $key => $value_1) {
                if (preg_match('#.*#', (string) $key)) {
                    $person[$key] = $value_1;
                }
            }

            return $person;
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

            if ($object->isInitialized('websiteUrl') && null !== $object->getWebsiteUrl()) {
                $data['website_url'] = $object->getWebsiteUrl();
            }

            if ($object->isInitialized('images') && null !== $object->getImages()) {
                $data['images'] = $this->normalizer->normalize($object->getImages(), 'json', $context);
            }

            if ($object->isInitialized('name') && null !== $object->getName()) {
                $data['name'] = $object->getName();
            }

            if ($object->isInitialized('givenName') && null !== $object->getGivenName()) {
                $data['given_name'] = $object->getGivenName();
            }

            if ($object->isInitialized('familyName') && null !== $object->getFamilyName()) {
                $data['family_name'] = $object->getFamilyName();
            }

            if ($object->isInitialized('alternateNames') && null !== $object->getAlternateNames()) {
                $values = [];
                foreach ($object->getAlternateNames() as $alternateName) {
                    $values[] = $alternateName;
                }

                $data['alternate_names'] = $values;
            }

            if ($object->isInitialized('birthday') && null !== $object->getBirthday()) {
                $data['birthday'] = $object->getBirthday();
            }

            if ($object->isInitialized('favorites') && null !== $object->getFavorites()) {
                $data['favorites'] = $object->getFavorites();
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
            return [Person::class => false];
        }
    }
}
