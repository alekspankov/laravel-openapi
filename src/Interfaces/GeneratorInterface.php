<?php

namespace Vyuldashev\LaravelOpenApi\Interfaces;

use GoldSpecDigital\ObjectOrientedOAS\OpenApi;

interface GeneratorInterface
{
    function generate(string $collection): OpenApi;
}