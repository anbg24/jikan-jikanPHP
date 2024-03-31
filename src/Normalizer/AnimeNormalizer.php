<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\Anime;
use Jikan\JikanPHP\Model\AnimeImages;
use Jikan\JikanPHP\Model\Broadcast;
use Jikan\JikanPHP\Model\Daterange;
use Jikan\JikanPHP\Model\MalUrl;
use Jikan\JikanPHP\Model\Title;
use Jikan\JikanPHP\Model\TrailerBase;
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
    class AnimeNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return Anime::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof Anime;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $anime = new Anime();
            if (\array_key_exists('score', $data) && \is_int($data['score'])) {
                $data['score'] = (float) $data['score'];
            }

            if (null === $data || !\is_array($data)) {
                return $anime;
            }

            if (\array_key_exists('mal_id', $data)) {
                $anime->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('url', $data)) {
                $anime->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('images', $data)) {
                $anime->setImages($this->denormalizer->denormalize($data['images'], AnimeImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('trailer', $data)) {
                $anime->setTrailer($this->denormalizer->denormalize($data['trailer'], TrailerBase::class, 'json', $context));
                unset($data['trailer']);
            }

            if (\array_key_exists('approved', $data)) {
                $anime->setApproved($data['approved']);
                unset($data['approved']);
            }

            if (\array_key_exists('titles', $data)) {
                $values = [];
                foreach ($data['titles'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, Title::class, 'json', $context);
                }

                $anime->setTitles($values);
                unset($data['titles']);
            }

            if (\array_key_exists('title', $data)) {
                $anime->setTitle($data['title']);
                unset($data['title']);
            }

            if (\array_key_exists('title_english', $data) && null !== $data['title_english']) {
                $anime->setTitleEnglish($data['title_english']);
                unset($data['title_english']);
            } elseif (\array_key_exists('title_english', $data) && null === $data['title_english']) {
                $anime->setTitleEnglish(null);
            }

            if (\array_key_exists('title_japanese', $data) && null !== $data['title_japanese']) {
                $anime->setTitleJapanese($data['title_japanese']);
                unset($data['title_japanese']);
            } elseif (\array_key_exists('title_japanese', $data) && null === $data['title_japanese']) {
                $anime->setTitleJapanese(null);
            }

            if (\array_key_exists('title_synonyms', $data)) {
                $values_1 = [];
                foreach ($data['title_synonyms'] as $value_1) {
                    $values_1[] = $value_1;
                }

                $anime->setTitleSynonyms($values_1);
                unset($data['title_synonyms']);
            }

            if (\array_key_exists('type', $data) && null !== $data['type']) {
                $anime->setType($data['type']);
                unset($data['type']);
            } elseif (\array_key_exists('type', $data) && null === $data['type']) {
                $anime->setType(null);
            }

            if (\array_key_exists('source', $data) && null !== $data['source']) {
                $anime->setSource($data['source']);
                unset($data['source']);
            } elseif (\array_key_exists('source', $data) && null === $data['source']) {
                $anime->setSource(null);
            }

            if (\array_key_exists('episodes', $data) && null !== $data['episodes']) {
                $anime->setEpisodes($data['episodes']);
                unset($data['episodes']);
            } elseif (\array_key_exists('episodes', $data) && null === $data['episodes']) {
                $anime->setEpisodes(null);
            }

            if (\array_key_exists('status', $data) && null !== $data['status']) {
                $anime->setStatus($data['status']);
                unset($data['status']);
            } elseif (\array_key_exists('status', $data) && null === $data['status']) {
                $anime->setStatus(null);
            }

            if (\array_key_exists('airing', $data)) {
                $anime->setAiring($data['airing']);
                unset($data['airing']);
            }

            if (\array_key_exists('aired', $data)) {
                $anime->setAired($this->denormalizer->denormalize($data['aired'], Daterange::class, 'json', $context));
                unset($data['aired']);
            }

            if (\array_key_exists('duration', $data) && null !== $data['duration']) {
                $anime->setDuration($data['duration']);
                unset($data['duration']);
            } elseif (\array_key_exists('duration', $data) && null === $data['duration']) {
                $anime->setDuration(null);
            }

            if (\array_key_exists('rating', $data) && null !== $data['rating']) {
                $anime->setRating($data['rating']);
                unset($data['rating']);
            } elseif (\array_key_exists('rating', $data) && null === $data['rating']) {
                $anime->setRating(null);
            }

            if (\array_key_exists('score', $data) && null !== $data['score']) {
                $anime->setScore($data['score']);
                unset($data['score']);
            } elseif (\array_key_exists('score', $data) && null === $data['score']) {
                $anime->setScore(null);
            }

            if (\array_key_exists('scored_by', $data) && null !== $data['scored_by']) {
                $anime->setScoredBy($data['scored_by']);
                unset($data['scored_by']);
            } elseif (\array_key_exists('scored_by', $data) && null === $data['scored_by']) {
                $anime->setScoredBy(null);
            }

            if (\array_key_exists('rank', $data) && null !== $data['rank']) {
                $anime->setRank($data['rank']);
                unset($data['rank']);
            } elseif (\array_key_exists('rank', $data) && null === $data['rank']) {
                $anime->setRank(null);
            }

            if (\array_key_exists('popularity', $data) && null !== $data['popularity']) {
                $anime->setPopularity($data['popularity']);
                unset($data['popularity']);
            } elseif (\array_key_exists('popularity', $data) && null === $data['popularity']) {
                $anime->setPopularity(null);
            }

            if (\array_key_exists('members', $data) && null !== $data['members']) {
                $anime->setMembers($data['members']);
                unset($data['members']);
            } elseif (\array_key_exists('members', $data) && null === $data['members']) {
                $anime->setMembers(null);
            }

            if (\array_key_exists('favorites', $data) && null !== $data['favorites']) {
                $anime->setFavorites($data['favorites']);
                unset($data['favorites']);
            } elseif (\array_key_exists('favorites', $data) && null === $data['favorites']) {
                $anime->setFavorites(null);
            }

            if (\array_key_exists('synopsis', $data) && null !== $data['synopsis']) {
                $anime->setSynopsis($data['synopsis']);
                unset($data['synopsis']);
            } elseif (\array_key_exists('synopsis', $data) && null === $data['synopsis']) {
                $anime->setSynopsis(null);
            }

            if (\array_key_exists('background', $data) && null !== $data['background']) {
                $anime->setBackground($data['background']);
                unset($data['background']);
            } elseif (\array_key_exists('background', $data) && null === $data['background']) {
                $anime->setBackground(null);
            }

            if (\array_key_exists('season', $data) && null !== $data['season']) {
                $anime->setSeason($data['season']);
                unset($data['season']);
            } elseif (\array_key_exists('season', $data) && null === $data['season']) {
                $anime->setSeason(null);
            }

            if (\array_key_exists('year', $data) && null !== $data['year']) {
                $anime->setYear($data['year']);
                unset($data['year']);
            } elseif (\array_key_exists('year', $data) && null === $data['year']) {
                $anime->setYear(null);
            }

            if (\array_key_exists('broadcast', $data)) {
                $anime->setBroadcast($this->denormalizer->denormalize($data['broadcast'], Broadcast::class, 'json', $context));
                unset($data['broadcast']);
            }

            if (\array_key_exists('producers', $data)) {
                $values_2 = [];
                foreach ($data['producers'] as $value_2) {
                    $values_2[] = $this->denormalizer->denormalize($value_2, MalUrl::class, 'json', $context);
                }

                $anime->setProducers($values_2);
                unset($data['producers']);
            }

            if (\array_key_exists('licensors', $data)) {
                $values_3 = [];
                foreach ($data['licensors'] as $value_3) {
                    $values_3[] = $this->denormalizer->denormalize($value_3, MalUrl::class, 'json', $context);
                }

                $anime->setLicensors($values_3);
                unset($data['licensors']);
            }

            if (\array_key_exists('studios', $data)) {
                $values_4 = [];
                foreach ($data['studios'] as $value_4) {
                    $values_4[] = $this->denormalizer->denormalize($value_4, MalUrl::class, 'json', $context);
                }

                $anime->setStudios($values_4);
                unset($data['studios']);
            }

            if (\array_key_exists('genres', $data)) {
                $values_5 = [];
                foreach ($data['genres'] as $value_5) {
                    $values_5[] = $this->denormalizer->denormalize($value_5, MalUrl::class, 'json', $context);
                }

                $anime->setGenres($values_5);
                unset($data['genres']);
            }

            if (\array_key_exists('explicit_genres', $data)) {
                $values_6 = [];
                foreach ($data['explicit_genres'] as $value_6) {
                    $values_6[] = $this->denormalizer->denormalize($value_6, MalUrl::class, 'json', $context);
                }

                $anime->setExplicitGenres($values_6);
                unset($data['explicit_genres']);
            }

            if (\array_key_exists('themes', $data)) {
                $values_7 = [];
                foreach ($data['themes'] as $value_7) {
                    $values_7[] = $this->denormalizer->denormalize($value_7, MalUrl::class, 'json', $context);
                }

                $anime->setThemes($values_7);
                unset($data['themes']);
            }

            if (\array_key_exists('demographics', $data)) {
                $values_8 = [];
                foreach ($data['demographics'] as $value_8) {
                    $values_8[] = $this->denormalizer->denormalize($value_8, MalUrl::class, 'json', $context);
                }

                $anime->setDemographics($values_8);
                unset($data['demographics']);
            }

            foreach ($data as $key => $value_9) {
                if (preg_match('#.*#', (string) $key)) {
                    $anime[$key] = $value_9;
                }
            }

            return $anime;
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

            if ($object->isInitialized('trailer') && null !== $object->getTrailer()) {
                $data['trailer'] = $this->normalizer->normalize($object->getTrailer(), 'json', $context);
            }

            if ($object->isInitialized('approved') && null !== $object->getApproved()) {
                $data['approved'] = $object->getApproved();
            }

            if ($object->isInitialized('titles') && null !== $object->getTitles()) {
                $values = [];
                foreach ($object->getTitles() as $title) {
                    $values[] = $this->normalizer->normalize($title, 'json', $context);
                }

                $data['titles'] = $values;
            }

            if ($object->isInitialized('title') && null !== $object->getTitle()) {
                $data['title'] = $object->getTitle();
            }

            if ($object->isInitialized('titleEnglish') && null !== $object->getTitleEnglish()) {
                $data['title_english'] = $object->getTitleEnglish();
            }

            if ($object->isInitialized('titleJapanese') && null !== $object->getTitleJapanese()) {
                $data['title_japanese'] = $object->getTitleJapanese();
            }

            if ($object->isInitialized('titleSynonyms') && null !== $object->getTitleSynonyms()) {
                $values_1 = [];
                foreach ($object->getTitleSynonyms() as $titleSynonym) {
                    $values_1[] = $titleSynonym;
                }

                $data['title_synonyms'] = $values_1;
            }

            if ($object->isInitialized('type') && null !== $object->getType()) {
                $data['type'] = $object->getType();
            }

            if ($object->isInitialized('source') && null !== $object->getSource()) {
                $data['source'] = $object->getSource();
            }

            if ($object->isInitialized('episodes') && null !== $object->getEpisodes()) {
                $data['episodes'] = $object->getEpisodes();
            }

            if ($object->isInitialized('status') && null !== $object->getStatus()) {
                $data['status'] = $object->getStatus();
            }

            if ($object->isInitialized('airing') && null !== $object->getAiring()) {
                $data['airing'] = $object->getAiring();
            }

            if ($object->isInitialized('aired') && null !== $object->getAired()) {
                $data['aired'] = $this->normalizer->normalize($object->getAired(), 'json', $context);
            }

            if ($object->isInitialized('duration') && null !== $object->getDuration()) {
                $data['duration'] = $object->getDuration();
            }

            if ($object->isInitialized('rating') && null !== $object->getRating()) {
                $data['rating'] = $object->getRating();
            }

            if ($object->isInitialized('score') && null !== $object->getScore()) {
                $data['score'] = $object->getScore();
            }

            if ($object->isInitialized('scoredBy') && null !== $object->getScoredBy()) {
                $data['scored_by'] = $object->getScoredBy();
            }

            if ($object->isInitialized('rank') && null !== $object->getRank()) {
                $data['rank'] = $object->getRank();
            }

            if ($object->isInitialized('popularity') && null !== $object->getPopularity()) {
                $data['popularity'] = $object->getPopularity();
            }

            if ($object->isInitialized('members') && null !== $object->getMembers()) {
                $data['members'] = $object->getMembers();
            }

            if ($object->isInitialized('favorites') && null !== $object->getFavorites()) {
                $data['favorites'] = $object->getFavorites();
            }

            if ($object->isInitialized('synopsis') && null !== $object->getSynopsis()) {
                $data['synopsis'] = $object->getSynopsis();
            }

            if ($object->isInitialized('background') && null !== $object->getBackground()) {
                $data['background'] = $object->getBackground();
            }

            if ($object->isInitialized('season') && null !== $object->getSeason()) {
                $data['season'] = $object->getSeason();
            }

            if ($object->isInitialized('year') && null !== $object->getYear()) {
                $data['year'] = $object->getYear();
            }

            if ($object->isInitialized('broadcast') && null !== $object->getBroadcast()) {
                $data['broadcast'] = $this->normalizer->normalize($object->getBroadcast(), 'json', $context);
            }

            if ($object->isInitialized('producers') && null !== $object->getProducers()) {
                $values_2 = [];
                foreach ($object->getProducers() as $producer) {
                    $values_2[] = $this->normalizer->normalize($producer, 'json', $context);
                }

                $data['producers'] = $values_2;
            }

            if ($object->isInitialized('licensors') && null !== $object->getLicensors()) {
                $values_3 = [];
                foreach ($object->getLicensors() as $licensor) {
                    $values_3[] = $this->normalizer->normalize($licensor, 'json', $context);
                }

                $data['licensors'] = $values_3;
            }

            if ($object->isInitialized('studios') && null !== $object->getStudios()) {
                $values_4 = [];
                foreach ($object->getStudios() as $studio) {
                    $values_4[] = $this->normalizer->normalize($studio, 'json', $context);
                }

                $data['studios'] = $values_4;
            }

            if ($object->isInitialized('genres') && null !== $object->getGenres()) {
                $values_5 = [];
                foreach ($object->getGenres() as $genre) {
                    $values_5[] = $this->normalizer->normalize($genre, 'json', $context);
                }

                $data['genres'] = $values_5;
            }

            if ($object->isInitialized('explicitGenres') && null !== $object->getExplicitGenres()) {
                $values_6 = [];
                foreach ($object->getExplicitGenres() as $explicitGenre) {
                    $values_6[] = $this->normalizer->normalize($explicitGenre, 'json', $context);
                }

                $data['explicit_genres'] = $values_6;
            }

            if ($object->isInitialized('themes') && null !== $object->getThemes()) {
                $values_7 = [];
                foreach ($object->getThemes() as $theme) {
                    $values_7[] = $this->normalizer->normalize($theme, 'json', $context);
                }

                $data['themes'] = $values_7;
            }

            if ($object->isInitialized('demographics') && null !== $object->getDemographics()) {
                $values_8 = [];
                foreach ($object->getDemographics() as $demographic) {
                    $values_8[] = $this->normalizer->normalize($demographic, 'json', $context);
                }

                $data['demographics'] = $values_8;
            }

            foreach ($object as $key => $value_9) {
                if (preg_match('#.*#', (string) $key)) {
                    $data[$key] = $value_9;
                }
            }

            return $data;
        }

        public function getSupportedTypes(?string $format = null): array
        {
            return [Anime::class => false];
        }
    }
} else {
    class AnimeNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return Anime::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof Anime;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|Anime
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $anime = new Anime();
            if (\array_key_exists('score', $data) && \is_int($data['score'])) {
                $data['score'] = (float) $data['score'];
            }

            if (null === $data || !\is_array($data)) {
                return $anime;
            }

            if (\array_key_exists('mal_id', $data)) {
                $anime->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('url', $data)) {
                $anime->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('images', $data)) {
                $anime->setImages($this->denormalizer->denormalize($data['images'], AnimeImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('trailer', $data)) {
                $anime->setTrailer($this->denormalizer->denormalize($data['trailer'], TrailerBase::class, 'json', $context));
                unset($data['trailer']);
            }

            if (\array_key_exists('approved', $data)) {
                $anime->setApproved($data['approved']);
                unset($data['approved']);
            }

            if (\array_key_exists('titles', $data)) {
                $values = [];
                foreach ($data['titles'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, Title::class, 'json', $context);
                }

                $anime->setTitles($values);
                unset($data['titles']);
            }

            if (\array_key_exists('title', $data)) {
                $anime->setTitle($data['title']);
                unset($data['title']);
            }

            if (\array_key_exists('title_english', $data) && null !== $data['title_english']) {
                $anime->setTitleEnglish($data['title_english']);
                unset($data['title_english']);
            } elseif (\array_key_exists('title_english', $data) && null === $data['title_english']) {
                $anime->setTitleEnglish(null);
            }

            if (\array_key_exists('title_japanese', $data) && null !== $data['title_japanese']) {
                $anime->setTitleJapanese($data['title_japanese']);
                unset($data['title_japanese']);
            } elseif (\array_key_exists('title_japanese', $data) && null === $data['title_japanese']) {
                $anime->setTitleJapanese(null);
            }

            if (\array_key_exists('title_synonyms', $data)) {
                $values_1 = [];
                foreach ($data['title_synonyms'] as $value_1) {
                    $values_1[] = $value_1;
                }

                $anime->setTitleSynonyms($values_1);
                unset($data['title_synonyms']);
            }

            if (\array_key_exists('type', $data) && null !== $data['type']) {
                $anime->setType($data['type']);
                unset($data['type']);
            } elseif (\array_key_exists('type', $data) && null === $data['type']) {
                $anime->setType(null);
            }

            if (\array_key_exists('source', $data) && null !== $data['source']) {
                $anime->setSource($data['source']);
                unset($data['source']);
            } elseif (\array_key_exists('source', $data) && null === $data['source']) {
                $anime->setSource(null);
            }

            if (\array_key_exists('episodes', $data) && null !== $data['episodes']) {
                $anime->setEpisodes($data['episodes']);
                unset($data['episodes']);
            } elseif (\array_key_exists('episodes', $data) && null === $data['episodes']) {
                $anime->setEpisodes(null);
            }

            if (\array_key_exists('status', $data) && null !== $data['status']) {
                $anime->setStatus($data['status']);
                unset($data['status']);
            } elseif (\array_key_exists('status', $data) && null === $data['status']) {
                $anime->setStatus(null);
            }

            if (\array_key_exists('airing', $data)) {
                $anime->setAiring($data['airing']);
                unset($data['airing']);
            }

            if (\array_key_exists('aired', $data)) {
                $anime->setAired($this->denormalizer->denormalize($data['aired'], Daterange::class, 'json', $context));
                unset($data['aired']);
            }

            if (\array_key_exists('duration', $data) && null !== $data['duration']) {
                $anime->setDuration($data['duration']);
                unset($data['duration']);
            } elseif (\array_key_exists('duration', $data) && null === $data['duration']) {
                $anime->setDuration(null);
            }

            if (\array_key_exists('rating', $data) && null !== $data['rating']) {
                $anime->setRating($data['rating']);
                unset($data['rating']);
            } elseif (\array_key_exists('rating', $data) && null === $data['rating']) {
                $anime->setRating(null);
            }

            if (\array_key_exists('score', $data) && null !== $data['score']) {
                $anime->setScore($data['score']);
                unset($data['score']);
            } elseif (\array_key_exists('score', $data) && null === $data['score']) {
                $anime->setScore(null);
            }

            if (\array_key_exists('scored_by', $data) && null !== $data['scored_by']) {
                $anime->setScoredBy($data['scored_by']);
                unset($data['scored_by']);
            } elseif (\array_key_exists('scored_by', $data) && null === $data['scored_by']) {
                $anime->setScoredBy(null);
            }

            if (\array_key_exists('rank', $data) && null !== $data['rank']) {
                $anime->setRank($data['rank']);
                unset($data['rank']);
            } elseif (\array_key_exists('rank', $data) && null === $data['rank']) {
                $anime->setRank(null);
            }

            if (\array_key_exists('popularity', $data) && null !== $data['popularity']) {
                $anime->setPopularity($data['popularity']);
                unset($data['popularity']);
            } elseif (\array_key_exists('popularity', $data) && null === $data['popularity']) {
                $anime->setPopularity(null);
            }

            if (\array_key_exists('members', $data) && null !== $data['members']) {
                $anime->setMembers($data['members']);
                unset($data['members']);
            } elseif (\array_key_exists('members', $data) && null === $data['members']) {
                $anime->setMembers(null);
            }

            if (\array_key_exists('favorites', $data) && null !== $data['favorites']) {
                $anime->setFavorites($data['favorites']);
                unset($data['favorites']);
            } elseif (\array_key_exists('favorites', $data) && null === $data['favorites']) {
                $anime->setFavorites(null);
            }

            if (\array_key_exists('synopsis', $data) && null !== $data['synopsis']) {
                $anime->setSynopsis($data['synopsis']);
                unset($data['synopsis']);
            } elseif (\array_key_exists('synopsis', $data) && null === $data['synopsis']) {
                $anime->setSynopsis(null);
            }

            if (\array_key_exists('background', $data) && null !== $data['background']) {
                $anime->setBackground($data['background']);
                unset($data['background']);
            } elseif (\array_key_exists('background', $data) && null === $data['background']) {
                $anime->setBackground(null);
            }

            if (\array_key_exists('season', $data) && null !== $data['season']) {
                $anime->setSeason($data['season']);
                unset($data['season']);
            } elseif (\array_key_exists('season', $data) && null === $data['season']) {
                $anime->setSeason(null);
            }

            if (\array_key_exists('year', $data) && null !== $data['year']) {
                $anime->setYear($data['year']);
                unset($data['year']);
            } elseif (\array_key_exists('year', $data) && null === $data['year']) {
                $anime->setYear(null);
            }

            if (\array_key_exists('broadcast', $data)) {
                $anime->setBroadcast($this->denormalizer->denormalize($data['broadcast'], Broadcast::class, 'json', $context));
                unset($data['broadcast']);
            }

            if (\array_key_exists('producers', $data)) {
                $values_2 = [];
                foreach ($data['producers'] as $value_2) {
                    $values_2[] = $this->denormalizer->denormalize($value_2, MalUrl::class, 'json', $context);
                }

                $anime->setProducers($values_2);
                unset($data['producers']);
            }

            if (\array_key_exists('licensors', $data)) {
                $values_3 = [];
                foreach ($data['licensors'] as $value_3) {
                    $values_3[] = $this->denormalizer->denormalize($value_3, MalUrl::class, 'json', $context);
                }

                $anime->setLicensors($values_3);
                unset($data['licensors']);
            }

            if (\array_key_exists('studios', $data)) {
                $values_4 = [];
                foreach ($data['studios'] as $value_4) {
                    $values_4[] = $this->denormalizer->denormalize($value_4, MalUrl::class, 'json', $context);
                }

                $anime->setStudios($values_4);
                unset($data['studios']);
            }

            if (\array_key_exists('genres', $data)) {
                $values_5 = [];
                foreach ($data['genres'] as $value_5) {
                    $values_5[] = $this->denormalizer->denormalize($value_5, MalUrl::class, 'json', $context);
                }

                $anime->setGenres($values_5);
                unset($data['genres']);
            }

            if (\array_key_exists('explicit_genres', $data)) {
                $values_6 = [];
                foreach ($data['explicit_genres'] as $value_6) {
                    $values_6[] = $this->denormalizer->denormalize($value_6, MalUrl::class, 'json', $context);
                }

                $anime->setExplicitGenres($values_6);
                unset($data['explicit_genres']);
            }

            if (\array_key_exists('themes', $data)) {
                $values_7 = [];
                foreach ($data['themes'] as $value_7) {
                    $values_7[] = $this->denormalizer->denormalize($value_7, MalUrl::class, 'json', $context);
                }

                $anime->setThemes($values_7);
                unset($data['themes']);
            }

            if (\array_key_exists('demographics', $data)) {
                $values_8 = [];
                foreach ($data['demographics'] as $value_8) {
                    $values_8[] = $this->denormalizer->denormalize($value_8, MalUrl::class, 'json', $context);
                }

                $anime->setDemographics($values_8);
                unset($data['demographics']);
            }

            foreach ($data as $key => $value_9) {
                if (preg_match('#.*#', (string) $key)) {
                    $anime[$key] = $value_9;
                }
            }

            return $anime;
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

            if ($object->isInitialized('trailer') && null !== $object->getTrailer()) {
                $data['trailer'] = $this->normalizer->normalize($object->getTrailer(), 'json', $context);
            }

            if ($object->isInitialized('approved') && null !== $object->getApproved()) {
                $data['approved'] = $object->getApproved();
            }

            if ($object->isInitialized('titles') && null !== $object->getTitles()) {
                $values = [];
                foreach ($object->getTitles() as $title) {
                    $values[] = $this->normalizer->normalize($title, 'json', $context);
                }

                $data['titles'] = $values;
            }

            if ($object->isInitialized('title') && null !== $object->getTitle()) {
                $data['title'] = $object->getTitle();
            }

            if ($object->isInitialized('titleEnglish') && null !== $object->getTitleEnglish()) {
                $data['title_english'] = $object->getTitleEnglish();
            }

            if ($object->isInitialized('titleJapanese') && null !== $object->getTitleJapanese()) {
                $data['title_japanese'] = $object->getTitleJapanese();
            }

            if ($object->isInitialized('titleSynonyms') && null !== $object->getTitleSynonyms()) {
                $values_1 = [];
                foreach ($object->getTitleSynonyms() as $titleSynonym) {
                    $values_1[] = $titleSynonym;
                }

                $data['title_synonyms'] = $values_1;
            }

            if ($object->isInitialized('type') && null !== $object->getType()) {
                $data['type'] = $object->getType();
            }

            if ($object->isInitialized('source') && null !== $object->getSource()) {
                $data['source'] = $object->getSource();
            }

            if ($object->isInitialized('episodes') && null !== $object->getEpisodes()) {
                $data['episodes'] = $object->getEpisodes();
            }

            if ($object->isInitialized('status') && null !== $object->getStatus()) {
                $data['status'] = $object->getStatus();
            }

            if ($object->isInitialized('airing') && null !== $object->getAiring()) {
                $data['airing'] = $object->getAiring();
            }

            if ($object->isInitialized('aired') && null !== $object->getAired()) {
                $data['aired'] = $this->normalizer->normalize($object->getAired(), 'json', $context);
            }

            if ($object->isInitialized('duration') && null !== $object->getDuration()) {
                $data['duration'] = $object->getDuration();
            }

            if ($object->isInitialized('rating') && null !== $object->getRating()) {
                $data['rating'] = $object->getRating();
            }

            if ($object->isInitialized('score') && null !== $object->getScore()) {
                $data['score'] = $object->getScore();
            }

            if ($object->isInitialized('scoredBy') && null !== $object->getScoredBy()) {
                $data['scored_by'] = $object->getScoredBy();
            }

            if ($object->isInitialized('rank') && null !== $object->getRank()) {
                $data['rank'] = $object->getRank();
            }

            if ($object->isInitialized('popularity') && null !== $object->getPopularity()) {
                $data['popularity'] = $object->getPopularity();
            }

            if ($object->isInitialized('members') && null !== $object->getMembers()) {
                $data['members'] = $object->getMembers();
            }

            if ($object->isInitialized('favorites') && null !== $object->getFavorites()) {
                $data['favorites'] = $object->getFavorites();
            }

            if ($object->isInitialized('synopsis') && null !== $object->getSynopsis()) {
                $data['synopsis'] = $object->getSynopsis();
            }

            if ($object->isInitialized('background') && null !== $object->getBackground()) {
                $data['background'] = $object->getBackground();
            }

            if ($object->isInitialized('season') && null !== $object->getSeason()) {
                $data['season'] = $object->getSeason();
            }

            if ($object->isInitialized('year') && null !== $object->getYear()) {
                $data['year'] = $object->getYear();
            }

            if ($object->isInitialized('broadcast') && null !== $object->getBroadcast()) {
                $data['broadcast'] = $this->normalizer->normalize($object->getBroadcast(), 'json', $context);
            }

            if ($object->isInitialized('producers') && null !== $object->getProducers()) {
                $values_2 = [];
                foreach ($object->getProducers() as $producer) {
                    $values_2[] = $this->normalizer->normalize($producer, 'json', $context);
                }

                $data['producers'] = $values_2;
            }

            if ($object->isInitialized('licensors') && null !== $object->getLicensors()) {
                $values_3 = [];
                foreach ($object->getLicensors() as $licensor) {
                    $values_3[] = $this->normalizer->normalize($licensor, 'json', $context);
                }

                $data['licensors'] = $values_3;
            }

            if ($object->isInitialized('studios') && null !== $object->getStudios()) {
                $values_4 = [];
                foreach ($object->getStudios() as $studio) {
                    $values_4[] = $this->normalizer->normalize($studio, 'json', $context);
                }

                $data['studios'] = $values_4;
            }

            if ($object->isInitialized('genres') && null !== $object->getGenres()) {
                $values_5 = [];
                foreach ($object->getGenres() as $genre) {
                    $values_5[] = $this->normalizer->normalize($genre, 'json', $context);
                }

                $data['genres'] = $values_5;
            }

            if ($object->isInitialized('explicitGenres') && null !== $object->getExplicitGenres()) {
                $values_6 = [];
                foreach ($object->getExplicitGenres() as $explicitGenre) {
                    $values_6[] = $this->normalizer->normalize($explicitGenre, 'json', $context);
                }

                $data['explicit_genres'] = $values_6;
            }

            if ($object->isInitialized('themes') && null !== $object->getThemes()) {
                $values_7 = [];
                foreach ($object->getThemes() as $theme) {
                    $values_7[] = $this->normalizer->normalize($theme, 'json', $context);
                }

                $data['themes'] = $values_7;
            }

            if ($object->isInitialized('demographics') && null !== $object->getDemographics()) {
                $values_8 = [];
                foreach ($object->getDemographics() as $demographic) {
                    $values_8[] = $this->normalizer->normalize($demographic, 'json', $context);
                }

                $data['demographics'] = $values_8;
            }

            foreach ($object as $key => $value_9) {
                if (preg_match('#.*#', (string) $key)) {
                    $data[$key] = $value_9;
                }
            }

            return $data;
        }

        public function getSupportedTypes(?string $format = null): array
        {
            return [Anime::class => false];
        }
    }
}
