<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\ClassMethod\ReturnTypeFromStrictScalarReturnExprRector;
use Rector\CodeQuality\Rector\New_\NewStaticToNewSelfRector;
use Rector\Config\RectorConfig;
use Rector\Core\Configuration\Option;
use Rector\Php74\Rector\Property\TypedPropertyRector;
use Rector\Php80\Rector\FunctionLike\UnionTypesRector;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNativeCallRector;
use Rector\TypeDeclaration\Rector\FunctionLike\ReturnTypeDeclarationRector;

return static function (RectorConfig $rectorConfig): void {

    $rectorConfig->parameters()->set(Option::PARALLEL_TIMEOUT_IN_SECONDS, 500);

    $rectorConfig->paths([
        __DIR__ . '/../src',
    ]);

    $rectorConfig->sets([
        SetList::PHP_70,
        SetList::PHP_71,
        SetList::PHP_72,
        //SetList::PHP_73,
        SetList::PHP_74,
        SetList::PHP_80,
        SetList::PHP_81,
        SetList::PHP_82,
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::NAMING,
    ]);

    $rectorConfig->rules([
        ReturnTypeDeclarationRector::class,
        UnionTypesRector::class,
        TypedPropertyRector::class,
        ReturnTypeFromStrictNativeCallRector::class,
        ReturnTypeFromStrictScalarReturnExprRector::class,
        NewStaticToNewSelfRector::class,
    ]);

    $rectorConfig->importNames();
};
