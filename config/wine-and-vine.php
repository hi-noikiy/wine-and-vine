<?php

return [
    'administrators' => [
        'rafaelmacedo@wine-and.vine.com',
    ],

    'data' => [


        /*
         * By default RoleSeeder class is loading this roles and building the database.
         * Each collection inside each role is its permissions that are being attached to the given role
         * To add more roles or more permissions, add them in this array.
         */
        'roles' => [
            [
                /**
                 * Admin Role
                 */
                'name' => 'admin',
                'guard_name' => 'web',
                'permissions' => [
                    ['name' => 'do anything', 'guard_name' => 'web'],
                ],
            ],
            [
                /**
                 * Support Role
                 */
                'name' => 'support',
                'guard_name' => 'web',
                'permissions' => [
                    ['name' => 'impersonate', 'guard_name' => 'web'],
                ]
            ],
            [
                /**
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
                /**
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
                /**
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