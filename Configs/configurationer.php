<?php

/**
 * Feed in Configurationer
 */

return [
    'tenancy' => [
        'is_enabled' => true,
        'header_attribute' => 'Axis-Host',
        'ignore_feature_check_for_host_users' => false,
        'sides' => [
            'HOST' => 2, // Who is hosting multiple tenants
            'TENANT' => 1 // A customer which has its own users, roles, permissions, settings... and uses the application completely isolated from other tenants
        ],
    ],

    'entities' => [
        'host' => [
            'identifier' => 'host',
            'key' => 'host',
            'name' => 'Host',
            'model' => App\Containers\Larabeans\Tenanter\Models\Host::class,
            'tasks' => [
                'get' => \App\Containers\Larabeans\Tenanter\Tasks\Configurationer\GetResolvedHostConfigurationTask::class,
                'create' => null,
                'update' => \App\Containers\Larabeans\Tenanter\Tasks\Configurationer\UpdateHostConfigurationTask::class
            ],
            'authenticate' => false,
            'load_in_default_task' => true,
            'default' => [
                'user_management' => [
                    'register_user_in_system' => true,
                    'new_user_active_by_default' => true,
                    'captcha_on_registration' => true,
                    'captcha_on_login' => true,
                    'enabled_cookie_consent' => true,
                    'enabled_session_timeout' => false,
                    'email_confirmation_for_login' => false,
                    'allow_profile_picture' => true
                ],
                'tenant_management' => [
                    'allow_profile_picture' => true,
                    'captcha_on_login' => true,
                    'captcha_on_registration' => true,
                    'email_confirmation_for_login' => true,
                    'enabled_cookie_consent' => true,
                    'enabled_session_timeout' => true,
                    'new_user_active_by_default' => true,
                    'register_user_in_system' => true,
                    'user_default_mode' => true,
                    'user_session_time' => true,
                ],
                'security' => [
                    'user_default_settings' => true,
                    'user_account_locking' => true,
                    'number_of_login_attemps' => 222,
                    'account_locking_duration' => 333,
                    'password' => [
                        'require_digit' => false,
                        'require_lowercase' => true,
                        'require_non_alphanumeric' => false,
                        'require_uppercase' => true,
                        'password_length' => 111,
                    ]
                ],
                'clock' => [
                    'provider' => 'unspecifiedClockProvider'
                ],
                'timing' => [
                    'time_zone_info' => [
                        'iana' => [
                            'time_zone_id' => 'Etc / UTC'
                        ]
                    ]
                ],
            ],
        ],
        'tenant' => [
            'identifier' => 'tenant',
            'key' => 'tenant',
            'name' => 'Tenant',
            'model' => App\Containers\Larabeans\Tenanter\Models\Tenant::class,
            'tasks' => [
                'get' => \App\Containers\Larabeans\Tenanter\Tasks\Configurationer\GetResolvedTenantConfigurationTask::class,
                'create' => null,
                'update' => \App\Containers\Larabeans\Tenanter\Tasks\Configurationer\UpdateTenantConfigurationTask::class
            ],
            'authenticate' => false,
            'load_in_default_task' => true,
            'default' => [
                'user_management' => [
                    'register_user_in_system' => true,
                    'new_user_active_by_default' => true,
                    'captcha_on_registration' => true,
                    'captcha_on_login' => true,
                    'enabled_cookie_consent' => true,
                    'enabled_session_timeout' => false,
                    'email_confirmation_for_login' => false,
                    'allow_profile_picture' => true
                ],
                'security' => [
                    'user_default_settings' => true,
                    'user_account_locking' => true,
                    'number_of_login_attemps' => 222,
                    'account_locking_duration' => 333,
                    'password' => [
                        'require_digit' => false,
                        'require_lowercase' => true,
                        'require_non_alphanumeric' => false,
                        'require_uppercase' => true,
                        'password_length' => 111,
                    ]
                ],
                'clock' => [
                    'provider' => 'unspecifiedClockProvider'
                ],
                'timing' => [
                    'time_zone_info' => [
                        'iana' => [
                            'time_zone_id' => 'Etc / UTC'
                        ]
                    ]
                ],
            ],
        ],
        'domain' => [
            'identifier' => 'domain',
            'key' => 'domain',
            'name' => 'Domain',
            'model' => App\Containers\Larabeans\Tenanter\Models\Domain::class,
            'tasks' => [
                'get' => \App\Containers\Larabeans\Tenanter\Tasks\Configurationer\GetResolvedDomainConfigurationTask::class,
                'create' => null,
                'update' => \App\Containers\Larabeans\Tenanter\Tasks\Configurationer\UpdateDomainConfigurationTask::class
            ],
            'authenticate' => false,
            'load_in_default_task' => true,
            'default' => [
                'branding' => [
                    'animation_logo' => null,
                    'style' => null
                ],
                'invoice' => [
                    'name' => 'Legal Name',
                    'address' => 'VPO',
                    'tax_number' => '313133'
                ],
            ],
        ]
    ],
];
