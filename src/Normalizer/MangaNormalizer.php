<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\Daterange;
use Jikan\JikanPHP\Model\MalUrl;
use Jikan\JikanPHP\Model\Manga;
use Jikan\JikanPHP\Model\MangaImages;
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
    class MangaNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return Manga::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof Manga;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $manga = new Manga();
            if (\array_key_exists('score', $data) && \is_int($data['score'])) {
                $data['score'] = (float) $data['score'];
            }

            if (null === $data || !\is_array($data)) {
                return $manga;
            }

            if (\array_key_exists('mal_id', $data)) {
                $manga->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('url', $data)) {
                $manga->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('images', $data)) {
                $manga->setImages($this->denormalizer->denormalize($data['images'], MangaImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('approved', $data)) {
                $manga->setApproved($data['approved']);
                unset($data['approved']);
            }

            if (\array_key_exists('titles', $data)) {
                $values = [];
                foreach ($data['titles'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, Title::class, 'json', $context);
                }

                $manga->setTitles($values);
                unset($data['titles']);
            }

            if (\array_key_exists('title', $data)) {
                $manga->setTitle($data['title']);
                unset($data['title']);
            }

            if (\array_key_exists('title_english', $data) && null !== $data['title_english']) {
                $manga->setTitleEnglish($data['title_english']);
                unset($data['title_english']);
            } elseif (\array_key_exists('title_english', $data) && null === $data['title_english']) {
                $manga->setTitleEnglish(null);
            }

            if (\array_key_exists('title_japanese', $data) && null !== $data['title_japanese']) {
                $manga->setTitleJapanese($data['title_japanese']);
                unset($data['title_japanese']);
            } elseif (\array_key_exists('title_japanese', $data) && null === $data['title_japanese']) {
                $manga->setTitleJapanese(null);
            }

            if (\array_key_exists('type', $data) && null !== $data['type']) {
                $manga->setType($data['type']);
                unset($data['type']);
            } elseif (\array_key_exists('type', $data) && null === $data['type']) {
                $manga->setType(null);
            }

            if (\array_key_exists('chapters', $data) && null !== $data['chapters']) {
                $manga->setChapters($data['chapters']);
                unset($data['chapters']);
            } elseif (\array_key_exists('chapters', $data) && null === $data['chapters']) {
                $manga->setChapters(null);
            }

            if (\array_key_exists('volumes', $data) && null !== $data['volumes']) {
                $manga->setVolumes($data['volumes']);
                unset($data['volumes']);
            } elseif (\array_key_exists('volumes', $data) && null === $data['volumes']) {
                $manga->setVolumes(null);
            }

            if (\array_key_exists('status', $data)) {
                $manga->setStatus($data['status']);
                unset($data['status']);
            }

            if (\array_key_exists('publishing', $data)) {
                $manga->setPublishing($data['publishing']);
                unset($data['publishing']);
            }

            if (\array_key_exists('published', $data)) {
                $manga->setPublished($this->denormalizer->denormalize($data['published'], Daterange::class, 'json', $context));
                unset($data['published']);
            }

            if (\array_key_exists('score', $data) && null !== $data['score']) {
                $manga->setScore($data['score']);
                unset($data['score']);
            } elseif (\array_key_exists('score', $data) && null === $data['score']) {
                $manga->setScore(null);
            }

            if (\array_key_exists('scored_by', $data) && null !== $data['scored_by']) {
                $manga->setScoredBy($data['scored_by']);
                unset($data['scored_by']);
            } elseif (\array_key_exists('scored_by', $data) && null === $data['scored_by']) {
                $manga->setScoredBy(null);
            }

            if (\array_key_exists('rank', $data) && null !== $data['rank']) {
                $manga->setRank($data['rank']);
                unset($data['rank']);
            } elseif (\array_key_exists('rank', $data) && null === $data['rank']) {
                $manga->setRank(null);
            }

            if (\array_key_exists('popularity', $data) && null !== $data['popularity']) {
                $manga->setPopularity($data['popularity']);
                unset($data['popularity']);
            } elseif (\array_key_exists('popularity', $data) && null === $data['popularity']) {
                $manga->setPopularity(null);
            }

            if (\array_key_exists('members', $data) && null !== $data['members']) {
                $manga->setMembers($data['members']);
                unset($data['members']);
            } elseif (\array_key_exists('members', $data) && null === $data['members']) {
                $manga->setMembers(null);
            }

            if (\array_key_exists('favorites', $data) && null !== $data['favorites']) {
                $manga->setFavorites($data['favorites']);
                unset($data['favorites']);
            } elseif (\array_key_exists('favorites', $data) && null === $data['favorites']) {
                $manga->setFavorites(null);
            }

            if (\array_key_exists('synopsis', $data) && null !== $data['synopsis']) {
                $manga->setSynopsis($data['synopsis']);
                unset($data['synopsis']);
            } elseif (\array_key_exists('synopsis', $data) && null === $data['synopsis']) {
                $manga->setSynopsis(null);
            }

            if (\array_key_exists('background', $data) && null !== $data['background']) {
                $manga->setBackground($data['background']);
                unset($data['background']);
            } elseif (\array_key_exists('background', $data) && null === $data['background']) {
                $manga->setBackground(null);
            }

            if (\array_key_exists('authors', $data)) {
                $values_1 = [];
                foreach ($data['authors'] as $value_1) {
                    $values_1[] = $this->denormalizer->denormalize($value_1, MalUrl::class, 'json', $context);
                }

                $manga->setAuthors($values_1);
                unset($data['authors']);
            }

            if (\array_key_exists('serializations', $data)) {
                $values_2 = [];
                foreach ($data['serializations'] as $value_2) {
                    $values_2[] = $this->denormalizer->denormalize($value_2, MalUrl::class, 'json', $context);
                }

                $manga->setSerializations($values_2);
                unset($data['serializations']);
            }

            if (\array_key_exists('genres', $data)) {
                $values_3 = [];
                foreach ($data['genres'] as $value_3) {
                    $values_3[] = $this->denormalizer->denormalize($value_3, MalUrl::class, 'json', $context);
                }

                $manga->setGenres($values_3);
                unset($data['genres']);
            }

            if (\array_key_exists('explicit_genres', $data)) {
                $values_4 = [];
                foreach ($data['explicit_genres'] as $value_4) {
                    $values_4[] = $this->denormalizer->denormalize($value_4, MalUrl::class, 'json', $context);
                }

                $manga->setExplicitGenres($values_4);
                unset($data['explicit_genres']);
            }

            if (\array_key_exists('themes', $data)) {
                $values_5 = [];
                foreach ($data['themes'] as $value_5) {
                    $values_5[] = $this->denormalizer->denormalize($value_5, MalUrl::class, 'json', $context);
                }

                $manga->setThemes($values_5);
                unset($data['themes']);
            }

            if (\array_key_exists('demographics', $data)) {
                $values_6 = [];
                foreach ($data['demographics'] as $value_6) {
                    $values_6[] = $this->denormalizer->denormalize($value_6, MalUrl::class, 'json', $context);
                }

                $manga->setDemographics($values_6);
                unset($data['demographics']);
            }

            foreach ($data as $key => $value_7) {
                if (preg_match('#.*#', (string) $key)) {
                    $manga[$key] = $value_7;
                }
            }

            return $manga;
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

            if ($object->isInitialized('type') && null !== $object->getType()) {
                $data['type'] = $object->getType();
            }

            if ($object->isInitialized('chapters') && null !== $object->getChapters()) {
                $data['chapters'] = $object->getChapters();
            }

            if ($object->isInitialized('volumes') && null !== $object->getVolumes()) {
                $data['volumes'] = $object->getVolumes();
            }

            if ($object->isInitialized('status') && null !== $object->getStatus()) {
                $data['status'] = $object->getStatus();
            }

            if ($object->isInitialized('publishing') && null !== $object->getPublishing()) {
                $data['publishing'] = $object->getPublishing();
            }

            if ($object->isInitialized('published') && null !== $object->getPublished()) {
                $data['published'] = $this->normalizer->normalize($object->getPublished(), 'json', $context);
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

            if ($object->isInitialized('authors') && null !== $object->getAuthors()) {
                $values_1 = [];
                foreach ($object->getAuthors() as $author) {
                    $values_1[] = $this->normalizer->normalize($author, 'json', $context);
                }

                $data['authors'] = $values_1;
            }

            if ($object->isInitialized('serializations') && null !== $object->getSerializations()) {
                $values_2 = [];
                foreach ($object->getSerializations() as $serialization) {
                    $values_2[] = $this->normalizer->normalize($serialization, 'json', $context);
                }

                $data['serializations'] = $values_2;
            }

            if ($object->isInitialized('genres') && null !== $object->getGenres()) {
                $values_3 = [];
                foreach ($object->getGenres() as $genre) {
                    $values_3[] = $this->normalizer->normalize($genre, 'json', $context);
                }

                $data['genres'] = $values_3;
            }

            if ($object->isInitialized('explicitGenres') && null !== $object->getExplicitGenres()) {
                $values_4 = [];
                foreach ($object->getExplicitGenres() as $explicitGenre) {
                    $values_4[] = $this->normalizer->normalize($explicitGenre, 'json', $context);
                }

                $data['explicit_genres'] = $values_4;
            }

            if ($object->isInitialized('themes') && null !== $object->getThemes()) {
                $values_5 = [];
                foreach ($object->getThemes() as $theme) {
                    $values_5[] = $this->normalizer->normalize($theme, 'json', $context);
                }

                $data['themes'] = $values_5;
            }

            if ($object->isInitialized('demographics') && null !== $object->getDemographics()) {
                $values_6 = [];
                foreach ($object->getDemographics() as $demographic) {
                    $values_6[] = $this->normalizer->normalize($demographic, 'json', $context);
                }

                $data['demographics'] = $values_6;
            }

            foreach ($object as $key => $value_7) {
                if (preg_match('#.*#', (string) $key)) {
                    $data[$key] = $value_7;
                }
            }

            return $data;
        }

        public function getSupportedTypes(?string $format = null): array
        {
            return [Manga::class => false];
        }
    }
} else {
    class MangaNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return Manga::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof Manga;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|Manga
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $manga = new Manga();
            if (\array_key_exists('score', $data) && \is_int($data['score'])) {
                $data['score'] = (float) $data['score'];
            }

            if (null === $data || !\is_array($data)) {
                return $manga;
            }

            if (\array_key_exists('mal_id', $data)) {
                $manga->setMalId($data['mal_id']);
                unset($data['mal_id']);
            }

            if (\array_key_exists('url', $data)) {
                $manga->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('images', $data)) {
                $manga->setImages($this->denormalizer->denormalize($data['images'], MangaImages::class, 'json', $context));
                unset($data['images']);
            }

            if (\array_key_exists('approved', $data)) {
                $manga->setApproved($data['approved']);
                unset($data['approved']);
            }

            if (\array_key_exists('titles', $data)) {
                $values = [];
                foreach ($data['titles'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, Title::class, 'json', $context);
                }

                $manga->setTitles($values);
                unset($data['titles']);
            }

            if (\array_key_exists('title', $data)) {
                $manga->setTitle($data['title']);
                unset($data['title']);
            }

            if (\array_key_exists('title_english', $data) && null !== $data['title_english']) {
                $manga->setTitleEnglish($data['title_english']);
                unset($data['title_english']);
            } elseif (\array_key_exists('title_english', $data) && null === $data['title_english']) {
                $manga->setTitleEnglish(null);
            }

            if (\array_key_exists('title_japanese', $data) && null !== $data['title_japanese']) {
                $manga->setTitleJapanese($data['title_japanese']);
                unset($data['title_japanese']);
            } elseif (\array_key_exists('title_japanese', $data) && null === $data['title_japanese']) {
                $manga->setTitleJapanese(null);
            }

            if (\array_key_exists('type', $data) && null !== $data['type']) {
                $manga->setType($data['type']);
                unset($data['type']);
            } elseif (\array_key_exists('type', $data) && null === $data['type']) {
                $manga->setType(null);
            }

            if (\array_key_exists('chapters', $data) && null !== $data['chapters']) {
                $manga->setChapters($data['chapters']);
                unset($data['chapters']);
            } elseif (\array_key_exists('chapters', $data) && null === $data['chapters']) {
                $manga->setChapters(null);
            }

            if (\array_key_exists('volumes', $data) && null !== $data['volumes']) {
                $manga->setVolumes($data['volumes']);
                unset($data['volumes']);
            } elseif (\array_key_exists('volumes', $data) && null === $data['volumes']) {
                $manga->setVolumes(null);
            }

            if (\array_key_exists('status', $data)) {
                $manga->setStatus($data['status']);
                unset($data['status']);
            }

            if (\array_key_exists('publishing', $data)) {
                $manga->setPublishing($data['publishing']);
                unset($data['publishing']);
            }

            if (\array_key_exists('published', $data)) {
                $manga->setPublished($this->denormalizer->denormalize($data['published'], Daterange::class, 'json', $context));
                unset($data['published']);
            }

            if (\array_key_exists('score', $data) && null !== $data['score']) {
                $manga->setScore($data['score']);
                unset($data['score']);
            } elseif (\array_key_exists('score', $data) && null === $data['score']) {
                $manga->setScore(null);
            }

            if (\array_key_exists('scored_by', $data) && null !== $data['scored_by']) {
                $manga->setScoredBy($data['scored_by']);
                unset($data['scored_by']);
            } elseif (\array_key_exists('scored_by', $data) && null === $data['scored_by']) {
                $manga->setScoredBy(null);
            }

            if (\array_key_exists('rank', $data) && null !== $data['rank']) {
                $manga->setRank($data['rank']);
                unset($data['rank']);
            } elseif (\array_key_exists('rank', $data) && null === $data['rank']) {
                $manga->setRank(null);
            }

            if (\array_key_exists('popularity', $data) && null !== $data['popularity']) {
                $manga->setPopularity($data['popularity']);
                unset($data['popularity']);
            } elseif (\array_key_exists('popularity', $data) && null === $data['popularity']) {
                $manga->setPopularity(null);
            }

            if (\array_key_exists('members', $data) && null !== $data['members']) {
                $manga->setMembers($data['members']);
                unset($data['members']);
            } elseif (\array_key_exists('members', $data) && null === $data['members']) {
                $manga->setMembers(null);
            }

            if (\array_key_exists('favorites', $data) && null !== $data['favorites']) {
                $manga->setFavorites($data['favorites']);
                unset($data['favorites']);
            } elseif (\array_key_exists('favorites', $data) && null === $data['favorites']) {
                $manga->setFavorites(null);
            }

            if (\array_key_exists('synopsis', $data) && null !== $data['synopsis']) {
                $manga->setSynopsis($data['synopsis']);
                unset($data['synopsis']);
            } elseif (\array_key_exists('synopsis', $data) && null === $data['synopsis']) {
                $manga->setSynopsis(null);
            }

            if (\array_key_exists('background', $data) && null !== $data['background']) {
                $manga->setBackground($data['background']);
                unset($data['background']);
            } elseif (\array_key_exists('background', $data) && null === $data['background']) {
                $manga->setBackground(null);
            }

            if (\array_key_exists('authors', $data)) {
                $values_1 = [];
                foreach ($data['authors'] as $value_1) {
                    $values_1[] = $this->denormalizer->denormalize($value_1, MalUrl::class, 'json', $context);
                }

                $manga->setAuthors($values_1);
                unset($data['authors']);
            }

            if (\array_key_exists('serializations', $data)) {
                $values_2 = [];
                foreach ($data['serializations'] as $value_2) {
                    $values_2[] = $this->denormalizer->denormalize($value_2, MalUrl::class, 'json', $context);
                }

                $manga->setSerializations($values_2);
                unset($data['serializations']);
            }

            if (\array_key_exists('genres', $data)) {
                $values_3 = [];
                foreach ($data['genres'] as $value_3) {
                    $values_3[] = $this->denormalizer->denormalize($value_3, MalUrl::class, 'json', $context);
                }

                $manga->setGenres($values_3);
                unset($data['genres']);
            }

            if (\array_key_exists('explicit_genres', $data)) {
                $values_4 = [];
                foreach ($data['explicit_genres'] as $value_4) {
                    $values_4[] = $this->denormalizer->denormalize($value_4, MalUrl::class, 'json', $context);
                }

                $manga->setExplicitGenres($values_4);
                unset($data['explicit_genres']);
            }

            if (\array_key_exists('themes', $data)) {
                $values_5 = [];
                foreach ($data['themes'] as $value_5) {
                    $values_5[] = $this->denormalizer->denormalize($value_5, MalUrl::class, 'json', $context);
                }

                $manga->setThemes($values_5);
                unset($data['themes']);
            }

            if (\array_key_exists('demographics', $data)) {
                $values_6 = [];
                foreach ($data['demographics'] as $value_6) {
                    $values_6[] = $this->denormalizer->denormalize($value_6, MalUrl::class, 'json', $context);
                }

                $manga->setDemographics($values_6);
                unset($data['demographics']);
            }

            foreach ($data as $key => $value_7) {
                if (preg_match('#.*#', (string) $key)) {
                    $manga[$key] = $value_7;
                }
            }

            return $manga;
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

            if ($object->isInitialized('type') && null !== $object->getType()) {
                $data['type'] = $object->getType();
            }

            if ($object->isInitialized('chapters') && null !== $object->getChapters()) {
                $data['chapters'] = $object->getChapters();
            }

            if ($object->isInitialized('volumes') && null !== $object->getVolumes()) {
                $data['volumes'] = $object->getVolumes();
            }

            if ($object->isInitialized('status') && null !== $object->getStatus()) {
                $data['status'] = $object->getStatus();
            }

            if ($object->isInitialized('publishing') && null !== $object->getPublishing()) {
                $data['publishing'] = $object->getPublishing();
            }

            if ($object->isInitialized('published') && null !== $object->getPublished()) {
                $data['published'] = $this->normalizer->normalize($object->getPublished(), 'json', $context);
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

            if ($object->isInitialized('authors') && null !== $object->getAuthors()) {
                $values_1 = [];
                foreach ($object->getAuthors() as $author) {
                    $values_1[] = $this->normalizer->normalize($author, 'json', $context);
                }

                $data['authors'] = $values_1;
            }

            if ($object->isInitialized('serializations') && null !== $object->getSerializations()) {
                $values_2 = [];
                foreach ($object->getSerializations() as $serialization) {
                    $values_2[] = $this->normalizer->normalize($serialization, 'json', $context);
                }

                $data['serializations'] = $values_2;
            }

            if ($object->isInitialized('genres') && null !== $object->getGenres()) {
                $values_3 = [];
                foreach ($object->getGenres() as $genre) {
                    $values_3[] = $this->normalizer->normalize($genre, 'json', $context);
                }

                $data['genres'] = $values_3;
            }

            if ($object->isInitialized('explicitGenres') && null !== $object->getExplicitGenres()) {
                $values_4 = [];
                foreach ($object->getExplicitGenres() as $explicitGenre) {
                    $values_4[] = $this->normalizer->normalize($explicitGenre, 'json', $context);
                }

                $data['explicit_genres'] = $values_4;
            }

            if ($object->isInitialized('themes') && null !== $object->getThemes()) {
                $values_5 = [];
                foreach ($object->getThemes() as $theme) {
                    $values_5[] = $this->normalizer->normalize($theme, 'json', $context);
                }

                $data['themes'] = $values_5;
            }

            if ($object->isInitialized('demographics') && null !== $object->getDemographics()) {
                $values_6 = [];
                foreach ($object->getDemographics() as $demographic) {
                    $values_6[] = $this->normalizer->normalize($demographic, 'json', $context);
                }

                $data['demographics'] = $values_6;
            }

            foreach ($object as $key => $value_7) {
                if (preg_match('#.*#', (string) $key)) {
                    $data[$key] = $value_7;
                }
            }

            return $data;
        }

        public function getSupportedTypes(?string $format = null): array
        {
            return [Manga::class => false];
        }
    }
}
