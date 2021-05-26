<?php

$menu = [
    [
        'title' => 'Главная',
        'sort'  => 0,
        'url'   => isset($isAuthorized) && $isAuthorized ? '/' : '/?login=true',
    ],
    [
        'title' => 'О нас',
        'sort'  => 4,
        'url'   => '/route/about/'
    ],
    [
        'title' => 'Контакты',
        'sort'  => 2,
        'url'   => '/route/contacts/'
    ],
    [
        'title' => 'Новости',
        'sort'  => 3,
        'url'   => '/route/news/'
    ],
    [
        'title' => 'Каталог',
        'sort'  => 1,
        'url'   => '/route/catalog/'
    ]
];
