<?php

namespace App\V1\Core\Application\Providers;

use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use ReflectionClass;

abstract class RouteServiceProvider extends ServiceProvider
{
    public const VERSION = 'v1';

    public const PREFIX = 'api';

    protected const PREFIX_PATTERN = '%s/%s';

    protected const PATTERN = '%s';

    protected bool $pluralPrefix = true;

    protected bool $prefix = true;

    public function getModuleProvider(): ModuleServiceProvider
    {
        $routeProviderReflection = new ReflectionClass($this);

        return Collection::make($this->app->getProviders(ModuleServiceProvider::class))
            ->filter(function (ModuleServiceProvider $moduleServiceProvider) use ($routeProviderReflection) {
                $reflection = new ReflectionClass($moduleServiceProvider);
                return str_starts_with($routeProviderReflection->getNamespaceName(), $reflection->getNamespaceName());
            })->first();
    }

    public static function getRoutePrefix(): string
    {
        return implode('/', [self::PREFIX, static::VERSION]);
    }

    public static function getBaseUrl(): string
    {
        return implode('/', [config('app.url'), trim(static::getRoutePrefix(), '/')]);
    }

    public function getModulePrefix(): string
    {
        $moduleName = $this->getModuleProvider()
            ->moduleName();
        return $this->pluralPrefix ? Str::plural($moduleName) : $moduleName;
    }

    public function getPrefix(): string
    {
        return $this->hasPrefix()
            ? sprintf(static::PREFIX_PATTERN, static::getRoutePrefix(), $this->getModulePrefix())
            : sprintf(static::PATTERN, static::getRoutePrefix());
    }

    public function map(Registrar $router): void
    {
        $router->group([
            'middleware' => $this->middlewares(),
            'prefix' => $this->getPrefix(),
        ], fn() => $this->registerRoutes($router));
    }

    abstract protected function registerRoutes(Registrar $router): void;

    protected function middlewares(): array
    {
        return ['api'];
    }

    final protected function hasPrefix(): bool
    {
        return $this->prefix;
    }
}
