<?php

/**
 * Массив с тегами и их параметром, необходим ли для этого тега закрывающий тег (вида <p>...</p>) или нет
 * (например, <hr>).
 *
 * Здесь перечисленна лишь часть тегов, для примера работы скрипта
 */

return [
    [
        'tag' => '<html>',
        'type' => 'double'
    ],
    [
        'tag' => '<head>',
        'type' => 'double'
    ],
    [
        'tag' => '<title>',
        'type' => 'double'
    ],
    [
        'tag' => '<meta>',
        'type' => 'single'
    ],
    [
        'tag' => '<body>',
        'type' => 'double'
    ],
    [
        'tag' => '<p>',
        'type' => 'double'
    ],
    [
        'tag' => '<hr>',
        'type' => 'single'
    ],
    [
        'tag' => '<img>',
        'type' => 'single'
    ],
    [
        'tag' => '<div>',
        'type' => 'double'
    ],
    [
        'tag' => '<span>',
        'type' => 'double'
    ],
    [
        'tag' => '<b>',
        'type' => 'double'
    ],
    [
        'tag' => '<i>',
        'type' => 'double'
    ],
    [
        'tag' => '<a>',
        'type' => 'double'
    ],
    [
        'tag' => '<pre>',
        'type' => 'double'
    ],
    [
        'tag' => '<frame>',
        'type' => 'single'
    ],
    [
        'tag' => '<frameset>',
        'type' => 'double'
    ],
    [
        'tag' => '<iframe>',
        'type' => 'double'
    ],
    [
        'tag' => '<h1>',
        'type' => 'double'
    ],
    [
        'tag' => '<h2>',
        'type' => 'double'
    ],
    [
        'tag' => '<h3>',
        'type' => 'double'
    ],
];