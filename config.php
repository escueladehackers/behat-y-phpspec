<?php
/**
 * PHP version 7.0
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
return [
    'settings' => [
        'displayErrorDetails' => true,
    ],
    'doctrine' => [
        'mapping_dirs' => [
            __DIR__ . '/infrastructure/Doctrine/Resources/config',
        ],
        'dev_mode' => true,
        'proxy_dir' => __DIR__ . '/var/doctrine/proxies',
        'connection' => [
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/var/ewallet.sq3',
        ],
    ],
    'twig' => [
        'options' => [
            'cache' => __DIR__ . '/var/cache/twig',
            'debug' => true,
            'strict_variables' => true,
        ],
        'loader_paths' => [
            __DIR__ . '/web/src/Twig/resources',
        ],
    ],
];
