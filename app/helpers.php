<?php

if (! function_exists('inspiring_quote')) {
    function inspiring_quote()
    {
        $quotes = require __DIR__ . '/../config/inspiring_quotes.php';

        return $quotes[array_rand($quotes)];
    }
}
