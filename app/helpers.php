<?php

function folio(string $name = null, $middleware = null, $withTrashed = null)
{
    if ($name) {
        \Laravel\Folio\name($name);
    }

    if ($middleware) {
        \Laravel\Folio\middleware($middleware);
    }

    if ($withTrashed) {
        \Laravel\Folio\withTrashed($withTrashed);
    }
}
