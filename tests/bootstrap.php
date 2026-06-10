<?php declare(strict_types=1);

spl_autoload_register(static function (string $class): void {
    $prefix = 'Jikan\\JikanPHP\\';

    if (! str_starts_with($class, $prefix)) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = __DIR__ . '/../src/' . str_replace('\\', '/', $relativeClass) . '.php';

    if (is_file($file)) {
        require_once $file;
    }
}, true, true);

$autoloadPaths = [
    __DIR__ . '/../vendor/autoload.php',
    dirname(__DIR__) . '/../../apps/anibinge_worker/vendor/autoload.php',
];

foreach ($autoloadPaths as $autoloadPath) {
    if (file_exists($autoloadPath)) {
        require_once $autoloadPath;

        return;
    }
}

throw new RuntimeException('Composer autoload not found for jikan-jikanPHP tests.');
