<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super-admin' => [
            'admins' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'pages' => 'c,r,u,d',
            'posts' => 'c,r,u,d',
            'settings' => 'c,r,u,d',
            'contact-messages' => 'c,r,u,d',
            'comments' => 'c,r,u,d',
        ],
        'admin'=>[

        ],
        'user'=>[

        ]

    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
