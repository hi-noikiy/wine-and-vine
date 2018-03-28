<?php

return [
    'administrators' => [
        'rafael@wine-vine.com',
    ],

    'data' => [
        'pagination' => 8,

        'currencies' => [
            'gbp' => [
                'name' => 'British Pound',
                'short_name' => 'GBP',
                'symbol' =>'£',
                'format' =>'symbol-price'
            ],
            'usd' => [
                'name' => 'Dollar',
                'short_name' =>'USD',
                'symbol' => '$',
                'format' =>'symbol-price'],
            'eur' => [
                'name' => 'Euro',
                'short_name' => 'EUR',
                'symbol' => '€',
                'format' =>'price-symbol']
        ],

        'images' => [
            'default_path' => [
                'users' => storage_path('app/public/defaults/images/users/user_default_avatar.png'),            // Using Spatie Media Library
                'wineries' => storage_path('app/public/defaults/images/wineries/winery_default.png'),           // Using Spatie Media Library
                'wines' => storage_path('app/public/defaults/images/wines/wine_default.png'),                   // Using Spatie Media Library
                'regions_hero' => storage_path('app/public/defaults/images/regions/hero/region_default_hero.png'),   // Using Spatie Media Library
                'wine_acidity' => storage_path('app/public/defaults/images/wine/acidity/wine_acidity_default.png'),
                'wine_acidity_thumbnail' => storage_path('app/public/defaults/images/wine/acidity/wine_acidity_default_thumbnail.png'),
                'wine_body' => storage_path('app/public/defaults/images/wine/body/wine_body_default.png'),
                'wine_body_thumbnail' => storage_path('app/public/defaults/images/wine/body/wine_body_default_thumbnail.png'),
                'wine_color' => storage_path('app/public/defaults/images/wine/color/wine_color_default.png'),
                'wine_color_thumbnail' => storage_path('app/public/defaults/images/wine/color/wine_color_default_thumbnail.png')
            ],

            'wine_acidities' => [
                'low' => [
                    'name' => 'Low',
                    'normal' => 'storage/defaults/images/wine/acidity/acidity_low.png',
                    'thumbnail' => 'storage/defaults/images/wine/acidity/acidity_low_thumbnail.png'
                ],
                'medium' => [
                    'name' => 'Medium',
                    'normal' => 'storage/defaults/images/wine/acidity/acidity_medium.png',
                    'thumbnail' => 'storage/defaults/images/wine/acidity/acidity_medium_thumbnail.png'
                ],
                'high' => [
                    'name' => 'High',
                    'normal' => 'storage/defaults/images/wine/acidity/acidity_high.png',
                    'thumbnail' => 'storage/defaults/images/wine/acidity/acidity_high_thumbnail.png'
                ],
                'very_high' => [
                    'name' => 'Very High',
                    'normal' => 'storage/defaults/images/wine/acidity/acidity_very_high.png',
                    'thumbnail' => 'storage/defaults/images/wine/acidity/acidity_very_high_thumbnail.png'
                ]
            ],

            'wine_bodies' => [
                'very_light_bodied' => [
                    'name' => 'Very Light Bodied',
                    'normal' => 'storage/defaults/images/wine/body/very_light_bodied.png',
                    'thumbnail' => 'storage/defaults/images/wine/body/very_light_bodied_thumbnail.png'
                ],
                'medium_bodied' => [
                    'name' => 'Medium Bodied',
                    'normal' => 'storage/defaults/images/wine/body/medium_bodied.png',
                    'thumbnail' => 'storage/defaults/images/wine/body/medium_bodied_thumbnail.png'
                ],
                'full_bodied' => [
                    'name' => 'Full Bodied',
                    'normal' => 'storage/defaults/images/wine/body/full_bodied.png',
                    'thumbnail' => 'storage/defaults/images/wine/body/full_bodied_thumbnail.png'
                ],
                'very_full_bodied' => [
                    'name' => 'Very Full Bodied',
                    'normal' => 'storage/defaults/images/wine/body/very_full_bodied.png',
                    'thumbnail' => 'storage/defaults/images/wine/body/very_full_bodied_thumbnail.png'
                ]
            ],

            'wine_colors' => [
                'almost_clear' => [
                    'name' => 'Almost Clear',
                    'normal' => 'storage/defaults/images/wine/color/almost_clear.png',
                    'thumbnail' => 'storage/defaults/images/wine/color/almost_clear_thumbnail.png'
                ],
                'green_yellow' => [
                    'name' => 'Green Yellow',
                    'normal' => 'storage/defaults/images/wine/color/green_yellow.png',
                    'thumbnail' => 'storage/defaults/images/wine/color/green_yellow_thumbnail.png'
                ],
                'platinum_yellow' => [
                    'name' => 'Platinum Yellow',
                    'normal' => 'storage/defaults/images/wine/color/platinum_yellow.png',
                    'thumbnail' => 'storage/defaults/images/wine/color/platinum_yellow_thumbnail.png'
                ],
                'pale_yellow' => [
                    'name' => 'Pale Yellow',
                    'normal' => 'storage/defaults/images/wine/color/pale_yellow.png',
                    'thumbnail' => 'storage/defaults/images/wine/color/pale_yellow_thumbnail.png'
                ],
                'pale_gold' => [
                    'name' => 'Pale Gold',
                    'normal' => 'storage/defaults/images/wine/color/pale_gold.png',
                    'thumbnail' => 'storage/defaults/images/wine/color/pale_gold_thumbnail.png'
                ],
                'deep_gold' => [
                    'name' => 'Deep Gold',
                    'normal' => 'storage/defaults/images/wine/color/deep_gold.png',
                    'thumbnail' => 'storage/defaults/images/wine/color/deep_gold_thumbnail.png'
                ],
                'pale_salmon' => [
                    'name' => 'Pale Salmon',
                    'normal' => 'storage/defaults/images/wine/color/pale_salmon.png',
                    'thumbnail' => 'storage/defaults/images/wine/color/pale_salmon_thumbnail.png'
                ],
                'deep_pink' => [
                    'name' => 'Deep Pink',
                    'normal' => 'storage/defaults/images/wine/color/deep_pink.png',
                    'thumbnail' => 'storage/defaults/images/wine/color/deep_pink_thumbnail.png'
                ],
                'deep_salmon' => [
                    'name' => 'Deep Salmon',
                    'normal' => 'storage/defaults/images/wine/color/deep_salmon.png',
                    'thumbnail' => 'storage/defaults/images/wine/color/deep_salmon_thumbnail.png'
                ],
                'pale_ruby' => [
                    'name' => 'Pale Ruby',
                    'normal' => 'storage/defaults/images/wine/color/pale_ruby.png',
                    'thumbnail' => 'storage/defaults/images/wine/color/pale_ruby_thumbnail.png'
                ],
                'deep_violet' => [
                    'name' => 'Deep Violet',
                    'normal' => 'storage/defaults/images/wine/color/deep_violet.png',
                    'thumbnail' => 'storage/defaults/images/wine/color/deep_violet_thumbnail.png'
                ],
                'deep_purple' => [
                    'name' => 'Deep Purple',
                    'normal' => 'storage/defaults/images/wine/color/deep_purple.png',
                    'thumbnail' => 'storage/defaults/images/wine/color/deep_purple_thumbnail.png'
                ],
                'tawny' => [
                    'name' => 'Tawny',
                    'normal' => 'storage/defaults/images/wine/color/tawny.png',
                    'thumbnail' => 'storage/defaults/images/wine/color/tawny_thumbnail.png'
                ]
            ]
        ],

        /*
         * By default RoleSeeder class is loading this roles and building the database.
         * Each collection inside each role is its permissions that are being attached to the given role
         * To add more roles or more permissions, add them in this array.
         */
        'roles' => [
            [
                /*
                 * Admin Role
                 */
                'name' => 'admin',
                'guard_name' => 'web',
                'permissions' => [
                    ['name' => 'do anything', 'guard_name' => 'web'],
                ],
            ],
            [
                /*
                 * Support Role
                 */
                'name' => 'support',
                'guard_name' => 'web',
                'permissions' => [
                    ['name' => 'impersonate', 'guard_name' => 'web'],
                ]
            ],
            [
                /*
                 * Winery Owner Role
                 */
                'name' => 'winery owner',
                'guard_name' => 'web',
                'permissions' => [
                    ['name' => 'contract an employee', 'guard_name' => 'web'],
                    ['name' => 'fire an employee', 'guard_name' => 'web'],
                    ['name' => 'edit winery', 'guard_name' => 'web'],
                    ['name' => 'add wines', 'guard_name' => 'web'],
                    ['name' => 'remove wines', 'guard_name' => 'web'],
                    ['name' => 'create a support ticket', 'guard_name' => 'web'],
                ]
            ],
            [
                /*
                 * Winery Employee Role
                 */
                'name' => 'winery employee',
                'guard_name' => 'web',
                'permissions' => [
                    ['name' => 'add wines', 'guard_name' => 'web'],
                    ['name' => 'remove wines', 'guard_name' => 'web'],
                    ['name' => 'create a support ticket', 'guard_name' => 'web'],
                ]
            ],
            [
                /*
                 * Client Role
                 */
                'name' => 'client',
                'guard_name' => 'web',
                'permissions' => [
                    ['name' => 'comment', 'guard_name' => 'web'],
                    ['name' => 'buy', 'guard_name' => 'web'],
                    ['name' => 'create a support ticket', 'guard_name' => 'web'],
                ]
            ]
        ]
    ]
];
