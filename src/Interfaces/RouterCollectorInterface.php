<?php

namespace Vyuldashev\LaravelOpenApi\Interfaces;

use Illuminate\Support\Collection;

interface RouterCollectorInterface
{
    function routes(): Collection;
}