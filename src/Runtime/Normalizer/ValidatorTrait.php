<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Runtime\Normalizer;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Validation;

trait ValidatorTrait
{
    protected function validate(array $data, Constraint $constraint): void
    {
        $validator = Validation::createValidator();
        $constraintViolationList = $validator->validate($data, $constraint);
        if ($constraintViolationList->count() > 0) {
            throw new ValidationException($constraintViolationList);
        }
    }
}
