<?php
namespace App\Traits;

trait Regexable
{
    function regex(string $pattern, string $string): ?array
    {
        $escapedPattern = preg_replace('/([\/\.\+\*\?\[\]\^\$\(\)])/', '\\\$1', $pattern);

        $regex = preg_replace_callback('/\{(\w+)\}/', function ($matches) {
            return '(?P<' . $matches[1] . '>[^_]+)';
        }, $escapedPattern);

        $regex = '/^' . $regex . '$/';

        if (preg_match($regex, $string, $matches)) {
            return array_intersect_key($matches, array_flip(array_filter(array_keys($matches), 'is_string')));
        }

        return null;
    }
}
