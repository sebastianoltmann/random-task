<?php

declare(strict_types=1);

namespace App\V1\Core\Application\Providers;

use Illuminate\Support\ServiceProvider;
use ReflectionClass;

abstract class ModuleServiceProvider extends ServiceProvider
{
    protected const TRANSLATIONS_PATH = 'Application/Translations';
    public const TRANSLATIONS_MODULE_SEPARATOR = '::';

    abstract public function moduleName(): string;

    public function register(): void
    {
        $this->loadTranslations();
    }

    private function loadTranslations(): void
    {
        $reflectionClass = new ReflectionClass($this);

        $translationsPath = join(DIRECTORY_SEPARATOR, [
            dirname($reflectionClass->getFileName()),
            static::TRANSLATIONS_PATH,
        ]);

        if (file_exists($translationsPath)) {
            $this->loadTranslationsFrom($translationsPath, $this->moduleName());
        }
    }
}
