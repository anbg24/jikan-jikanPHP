<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Runtime\Normalizer;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends \RuntimeException
{
    public function __construct(private ConstraintViolationListInterface $constraintViolationList)
    {
        parent::__construct(sprintf('Model validation failed with %d errors.', $constraintViolationList->count()), 400);
    }

    public function getViolationList(): ConstraintViolationListInterface
    {
        return $this->constraintViolationList;
    }
}
