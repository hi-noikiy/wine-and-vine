<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'fa-sprites' => [
            'driver' => 'local',
            'root'   => storage_path('app/public/icons/sprites/fa'),
            'url' => env('APP_URL').'/storage/icons/sprites/fa',
            'visibility' => 'public',
        ],

        'media_users_avatars' => [
            'driver' => 'local',
            'root'   => storage_path('app/public/images/users/avatars'),
            'url' => env('APP_URL').'/storage/images/users/avatars',
            'visibility' => 'public',
        ],

        'media_wineries_images' => [
            'driver' => 'local',
            'root'   => storage_path('app/public/images/wineries'),
            'url' => env('APP_URL').'/storage/images/wineries',
            'visibility' => 'public',
        ],

        'media_wines_images' => [
            'driver' => 'local',
            'root'   => storage_path('app/public/images/wines'),
            'url' => env('APP_URL').'/storage/images/wines',
            'visibility' => 'public',
        ],

        'media_regions_hero' => [
            'driver' => 'local',
            'root'   => storage_path('app/public/images/regions/hero'),
            'url' => env('APP_URL').'/storage/images/regions/hero',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],

    ],

];
