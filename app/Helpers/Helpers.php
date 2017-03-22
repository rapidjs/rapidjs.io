<?php

/**
 * Make a route for the docs from a key and a value
 *
 * @param  string  $section The section name on the docs page
 * @param  string  $keyName The sub key section of the method, definition, etc.
 * @return string $route
 */
function makeDocsRoute ($section = '', $keyName = '') {
    $delimeter = '-';

    return '#' . implode($delimeter, [$section, $keyName]);
}

function makeDocsRouteLink ($section = '', $keyName = '', $text = '') {
    return '<a href="' . makeDocsRoute($section, $keyName) . '">' . $text . '</a>';
}

function makeDocsRoutesLinks ($routes) {
    $links = [];

    if (!empty($routes)) {
        foreach ($routes as $route) {
            $links[] = makeDocsRouteLink($route['section'], $route['key'], $route['text']);
        }
    }

    return $links;
}

function getDocFiles ($directory) {
    $fileNames = [];
    $files = glob(implode('/', array_filter([resource_path('views'), 'documentation', $directory, '**'])));

    if(!empty($files)) {
        foreach($files as $file) {
            $fileNames[] = str_replace('.blade', '', File::name($file));
        }
    }

    return array_filter($fileNames, function ($file) { return $file != 'master'; });
}
