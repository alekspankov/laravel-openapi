<?php

namespace Vyuldashev\LaravelOpenApi;

use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use Vyuldashev\LaravelOpenApi\Interfaces\RouterCollectorInterface;

class RouterCollector implements RouterCollectorInterface
{
    public function routes(): Collection
    {
        /** @noinspection CollectFunctionInCollectionInspection */
        return collect(app(Router::class)->getRoutes())
            ->filter(static fn(Route $route) => $route->getActionName() !== 'Closure')
            ->map(static fn(Route $route) => RouteInformation::createFromRoute($route))
            ->filter(static function (RouteInformation $route) {
                $pathItem = $route->controllerAttributes
                    ->first(static fn(object $attribute) => $attribute instanceof Attributes\PathItem);

                $operation = $route->actionAttributes
                    ->first(static fn(object $attribute) => $attribute instanceof Attributes\Operation);

                return $pathItem && $operation;
            });
    }
}