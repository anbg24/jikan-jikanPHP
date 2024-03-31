<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\AnimeEpisode;
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
    class AnimeEpisodeNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return AnimeEpisode::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof AnimeEpisode;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $animeEpisode = new AnimeEpisode();
            if (null === $data || !\is_array($data)) {
                return $animeEpisode;
            }

            if (\array_key_exists('mal_id', $data)) {
                $animeEpisode->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('url', $data)) {
                $animeEpisode->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('title', $data)) {
                $animeEpisode->setTitle($data['title']);
                unset($data['title']);
            }

            if (\array_key_exists('title_japanese', $data) && null !== $data['title_japanese']) {
                $animeEpisode->setTitleJapanese($data['title_japanese']);
                unset($data['title_japanese']);
            } elseif (\array_key_exists('title_japanese', $data) && null === $data['title_japanese']) {
                $animeEpisode->setTitleJapanese(null);
            }

            if (\array_key_exists('title_romanji', $data) && null !== $data['title_romanji']) {
                $animeEpisode->setTitleRomanji($data['title_romanji']);
                unset($data['title_romanji']);
            } elseif (\array_key_exists('title_romanji', $data) && null === $data['title_romanji']) {
                $animeEpisode->setTitleRomanji(null);
            }

            if (\array_key_exists('duration', $data) && null !== $data['duration']) {
                $animeEpisode->setDuration($data['duration']);
                unset($data['duration']);
            } elseif (\array_key_exists('duration', $data) && null === $data['duration']) {
                $animeEpisode->setDuration(null);
            }

            if (\array_key_exists('aired', $data) && null !== $data['aired']) {
                $animeEpisode->setAired($data['aired']);
                unset($data['aired']);
            } elseif (\array_key_exists('aired', $data) && null === $data['aired']) {
                $animeEpisode->setAired(null);
            }

            if (\array_key_exists('filler', $data)) {
                $animeEpisode->setFiller($data['filler']);
                unset($data['filler']);
            }

            if (\array_key_exists('recap', $data)) {
                $animeEpisode->setRecap($data['recap']);
                unset($data['recap']);
            }

            if (\array_key_exists('synopsis', $data) && null !== $data['synopsis']) {
                $animeEpisode->setSynopsis($data['synopsis']);
                unset($data['synopsis']);
            } elseif (\array_key_exists('synopsis', $data) && null === $data['synopsis']) {
                $animeEpisode->setSynopsis(null);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $animeEpisode[$key] = $value;
                }
            }

            return $animeEpisode;
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

            if ($object->isInitialized('title') && null !== $object->getTitle()) {
                $data['title'] = $object->getTitle();
            }

            if ($object->isInitialized('titleJapanese') && null !== $object->getTitleJapanese()) {
                $data['title_japanese'] = $object->getTitleJapanese();
            }

            if ($object->isInitialized('titleRomanji') && null !== $object->getTitleRomanji()) {
                $data['title_romanji'] = $object->getTitleRomanji();
            }

            if ($object->isInitialized('duration') && null !== $object->getDuration()) {
                $data['duration'] = $object->getDuration();
            }

            if ($object->isInitialized('aired') && null !== $object->getAired()) {
                $data['aired'] = $object->getAired();
            }

            if ($object->isInitialized('filler') && null !== $object->getFiller()) {
                $data['filler'] = $object->getFiller();
            }

            if ($object->isInitialized('recap') && null !== $object->getRecap()) {
                $data['recap'] = $object->getRecap();
            }

            if ($object->isInitialized('synopsis') && null !== $object->getSynopsis()) {
                $data['synopsis'] = $object->getSynopsis();
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
            return [AnimeEpisode::class => false];
        }
    }
} else {
    class AnimeEpisodeNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return AnimeEpisode::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof AnimeEpisode;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|AnimeEpisode
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $animeEpisode = new AnimeEpisode();
            if (null === $data || !\is_array($data)) {
                return $animeEpisode;
            }

            if (\array_key_exists('mal_id', $data)) {
                $animeEpisode->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('url', $data)) {
                $animeEpisode->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('title', $data)) {
                $animeEpisode->setTitle($data['title']);
                unset($data['title']);
            }

            if (\array_key_exists('title_japanese', $data) && null !== $data['title_japanese']) {
                $animeEpisode->setTitleJapanese($data['title_japanese']);
                unset($data['title_japanese']);
            } elseif (\array_key_exists('title_japanese', $data) && null === $data['title_japanese']) {
                $animeEpisode->setTitleJapanese(null);
            }

            if (\array_key_exists('title_romanji', $data) && null !== $data['title_romanji']) {
                $animeEpisode->setTitleRomanji($data['title_romanji']);
                unset($data['title_romanji']);
            } elseif (\array_key_exists('title_romanji', $data) && null === $data['title_romanji']) {
                $animeEpisode->setTitleRomanji(null);
            }

            if (\array_key_exists('duration', $data) && null !== $data['duration']) {
                $animeEpisode->setDuration($data['duration']);
                unset($data['duration']);
            } elseif (\array_key_exists('duration', $data) && null === $data['duration']) {
                $animeEpisode->setDuration(null);
            }

            if (\array_key_exists('aired', $data) && null !== $data['aired']) {
                $animeEpisode->setAired($data['aired']);
                unset($data['aired']);
            } elseif (\array_key_exists('aired', $data) && null === $data['aired']) {
                $animeEpisode->setAired(null);
            }

            if (\array_key_exists('filler', $data)) {
                $animeEpisode->setFiller($data['filler']);
                unset($data['filler']);
            }

            if (\array_key_exists('recap', $data)) {
                $animeEpisode->setRecap($data['recap']);
                unset($data['recap']);
            }

            if (\array_key_exists('synopsis', $data) && null !== $data['synopsis']) {
                $animeEpisode->setSynopsis($data['synopsis']);
                unset($data['synopsis']);
            } elseif (\array_key_exists('synopsis', $data) && null === $data['synopsis']) {
                $animeEpisode->setSynopsis(null);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $animeEpisode[$key] = $value;
                }
            }

            return $animeEpisode;
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

            if ($object->isInitialized('title') && null !== $object->getTitle()) {
                $data['title'] = $object->getTitle();
            }

            if ($object->isInitialized('titleJapanese') && null !== $object->getTitleJapanese()) {
                $data['title_japanese'] = $object->getTitleJapanese();
            }

            if ($object->isInitialized('titleRomanji') && null !== $object->getTitleRomanji()) {
                $data['title_romanji'] = $object->getTitleRomanji();
            }

            if ($object->isInitialized('duration') && null !== $object->getDuration()) {
                $data['duration'] = $object->getDuration();
            }

            if ($object->isInitialized('aired') && null !== $object->getAired()) {
                $data['aired'] = $object->getAired();
            }

            if ($object->isInitialized('filler') && null !== $object->getFiller()) {
                $data['filler'] = $object->getFiller();
            }

            if ($object->isInitialized('recap') && null !== $object->getRecap()) {
                $data['recap'] = $object->getRecap();
            }

            if ($object->isInitialized('synopsis') && null !== $object->getSynopsis()) {
                $data['synopsis'] = $object->getSynopsis();
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
            return [AnimeEpisode::class => false];
        }
    }
}
