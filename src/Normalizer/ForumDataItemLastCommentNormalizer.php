<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jikan\JikanPHP\Model\ForumDataItemLastComment;
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
    class ForumDataItemLastCommentNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
        {
            return ForumDataItemLastComment::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof ForumDataItemLastComment;
        }

        public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $forumDataItemLastComment = new ForumDataItemLastComment();
            if (null === $data || !\is_array($data)) {
                return $forumDataItemLastComment;
            }

            if (\array_key_exists('url', $data)) {
                $forumDataItemLastComment->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('author_username', $data)) {
                $forumDataItemLastComment->setAuthorUsername($data['author_username']);
                unset($data['author_username']);
            }

            if (\array_key_exists('author_url', $data)) {
                $forumDataItemLastComment->setAuthorUrl($data['author_url']);
                unset($data['author_url']);
            }

            if (\array_key_exists('date', $data) && null !== $data['date']) {
                $forumDataItemLastComment->setDate($data['date']);
                unset($data['date']);
            } elseif (\array_key_exists('date', $data) && null === $data['date']) {
                $forumDataItemLastComment->setDate(null);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $forumDataItemLastComment[$key] = $value;
                }
            }

            return $forumDataItemLastComment;
        }

        public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('url') && null !== $object->getUrl()) {
                $data['url'] = $object->getUrl();
            }

            if ($object->isInitialized('authorUsername') && null !== $object->getAuthorUsername()) {
                $data['author_username'] = $object->getAuthorUsername();
            }

            if ($object->isInitialized('authorUrl') && null !== $object->getAuthorUrl()) {
                $data['author_url'] = $object->getAuthorUrl();
            }

            if ($object->isInitialized('date') && null !== $object->getDate()) {
                $data['date'] = $object->getDate();
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
            return [ForumDataItemLastComment::class => false];
        }
    }
} else {
    class ForumDataItemLastCommentNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;

        public function supportsDenormalization($data, $type, ?string $format = null, array $context = []): bool
        {
            return ForumDataItemLastComment::class === $type;
        }

        public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
        {
            return is_object($data) && $data instanceof ForumDataItemLastComment;
        }

        /**
         * @param null|mixed $format
         */
        public function denormalize($data, $type, $format = null, array $context = []): Reference|ForumDataItemLastComment
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }

            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }

            $forumDataItemLastComment = new ForumDataItemLastComment();
            if (null === $data || !\is_array($data)) {
                return $forumDataItemLastComment;
            }

            if (\array_key_exists('url', $data)) {
                $forumDataItemLastComment->setUrl($data['url']);
                unset($data['url']);
            }

            if (\array_key_exists('author_username', $data)) {
                $forumDataItemLastComment->setAuthorUsername($data['author_username']);
                unset($data['author_username']);
            }

            if (\array_key_exists('author_url', $data)) {
                $forumDataItemLastComment->setAuthorUrl($data['author_url']);
                unset($data['author_url']);
            }

            if (\array_key_exists('date', $data) && null !== $data['date']) {
                $forumDataItemLastComment->setDate($data['date']);
                unset($data['date']);
            } elseif (\array_key_exists('date', $data) && null === $data['date']) {
                $forumDataItemLastComment->setDate(null);
            }

            foreach ($data as $key => $value) {
                if (preg_match('#.*#', (string) $key)) {
                    $forumDataItemLastComment[$key] = $value;
                }
            }

            return $forumDataItemLastComment;
        }

        /**
         * @param null|mixed $format
         *
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('url') && null !== $object->getUrl()) {
                $data['url'] = $object->getUrl();
            }

            if ($object->isInitialized('authorUsername') && null !== $object->getAuthorUsername()) {
                $data['author_username'] = $object->getAuthorUsername();
            }

            if ($object->isInitialized('authorUrl') && null !== $object->getAuthorUrl()) {
                $data['author_url'] = $object->getAuthorUrl();
            }

            if ($object->isInitialized('date') && null !== $object->getDate()) {
                $data['date'] = $object->getDate();
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
            return [ForumDataItemLastComment::class => false];
        }
    }
}
