<?php
/**
 * Created by PhpStorm.
 * User: slim
 * Date: 13/10/17
 * Time: 12:33
 */

define('DIRSEP', DIRECTORY_SEPARATOR);

$settings = [
  "settings" => [
    'displayErrorDetails' => true,
    'addContentLengthHeader' => false,
    'mode' => 'development',
    'debug' => true,
    'view' => [
      'template_path' => __DIR__ . '/templates/',
      'twig' => [
        'cache' => false,
        'auto_reload' => true
      ],
    ],
  ]
];

return $settings;
