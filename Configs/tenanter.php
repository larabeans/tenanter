<?php
return [

    /**
     * The list of host domains.
     *
     * Only relevant if you're using the domain or subdomain identification middleware.
     */
    'host_domains' => [],

    'models' => [
        'host' => App\Containers\Larabeans\Tenanter\Models\Host::class,
        'tenant' => App\Containers\Larabeans\Tenanter\Models\Tenant::class,
        'domain' => App\Containers\Larabeans\Tenanter\Models\Domain::class,
        'detail' => [
            // FORMAT: business detail model
            // 'identifier' => null,   // e.g. shop
            // 'key' => null,
            // 'name' => null,
            // 'model' => null,        // e.g. shop model
            // 'tasks' => [
            //    'get' => null,      // e.g. get shop task
            //    'create' => null,
            //    'update' => null
            // ]
        ],
    ],

    'tenant_column' => 'tenant_id',

    'default_id' => null,

    /**
    *--------------------------------------------------------------------------
    *     Ignore tables list
    *--------------------------------------------------------------------------
    *
    * - We may want to exclude few tables to use tenant_id
    * - It is required to skip these tables in migration, while adding tenant_id column
    * - It is required to skip tenant_id global check, while quering on these tables
    * - It is required to skip tenant_id column value set, while creating record on these tables
    *
    */

    'ignore_tables' => [
        "jobs",
        "failed_jobs",
        "migrations",

        "oauth_access_tokens",
        "oauth_auth_codes",
        "oauth_clients",
        "oauth_personal_access_clients",
        "oauth_refresh_tokens",
        "password_resets",

        "permissions",
        "role_has_permissions",
        "model_has_permissions",
        "model_has_roles",

        "countries",
        "states",
        "cities",

        "configurations",
        "tenants",
        "domains",
        "hosts"
    ],


    // means host only permissions
    'admin_only_permissions' => [
        'manage-tenant',
        'create-tenant',
        'delete-tenant',
        'edit-host-configuration'
    ],


    /**
     * Tenancy bootstrappers are executed when tenancy is initialized.
     * Their responsibility is making Laravel features tenant-aware.
     *
     * To configure their behavior, see the config keys below.
     */
    'bootstrappers' => [
         # App\Containers\Larabeans\Tenanter\Bootstrappers\DatabaseTenancyBootstrapper::class,
         App\Containers\Larabeans\Tenanter\Bootstrappers\CacheTenancyBootstrapper::class,
         App\Containers\Larabeans\Tenanter\Bootstrappers\FilesystemTenancyBootstrapper::class,
         App\Containers\Larabeans\Tenanter\Bootstrappers\QueueTenancyBootstrapper::class,
         App\Containers\Larabeans\Tenanter\Bootstrappers\RedisTenancyBootstrapper::class, // Note: phpredis is needed
    ],

    /**
     * Cache tenancy config. Used by CacheTenancyBootstrapper.
     *
     * This works for all Cache facade calls, cache() helper
     * calls and direct calls to injected cache stores.
     *
     * Each key in cache will have a tag applied on it. This tag is used to
     * scope the cache both when writing to it and when reading from it.
     *
     * You can clear cache selectively by specifying the tag.
     */
    'cache' => [
        'tag_base' => 'tenant', // This tag_base, followed by the tenant_id, will form a tag that will be applied on each cache call.
    ],

    /**
     * Filesystem tenancy config. Used by FilesystemTenancyBootstrapper.
     * https://larabeans.com/docs/v3/tenancy-bootstrappers/#filesystem-tenancy-boostrapper.
     */
    'filesystem' => [
        /**
         * Each disk listed in the 'disks' array will be suffixed by the suffix_base, followed by the tenant_id.
         */
        'suffix_base' => 'tenant',
        'disks' => [
            'local',
            'public',
            // 's3',
        ],

        /**
         * Use this for local disks.
         *
         * See https://larabeans.com/docs/v3/tenancy-bootstrappers/#filesystem-tenancy-boostrapper
         */
        'root_override' => [
            // Disks whose roots should be overriden after storage_path() is suffixed.
            'local' => '%storage_path%/app/',
            'public' => '%storage_path%/app/public/',
        ],

        /**
         * Should storage_path() be suffixed.
         *
         * Note: Disabling this will likely break local disk tenancy. Only disable this if you're using an external file storage service like S3.
         *
         * For the vast majority of applications, this feature should be enabled. But in some
         * edge cases, it can cause issues (like using Passport with Vapor - see #196), so
         * you may want to disable this if you are experiencing these edge case issues.
         */
        'suffix_storage_path' => true,

        /**
         * By default, asset() calls are made multi-tenant too. You can use global_asset() and mix()
         * for global, non-tenant-specific assets. However, you might have some issues when using
         * packages that use asset() calls inside the tenant app. To avoid such issues, you can
         * disable asset() helper tenancy and explicitly use tenant_asset() calls in places
         * where you want to use tenant-specific assets (product images, avatars, etc).
         */
        'asset_helper_tenancy' => true,
    ],

    /**
     * Redis tenancy config. Used by RedisTenancyBoostrapper.
     *
     * Note: You need phpredis to use Redis tenancy.
     *
     * Note: You don't need to use this if you're using Redis only for cache.
     * Redis tenancy is only relevant if you're making direct Redis calls,
     * either using the Redis facade or by injecting it as a dependency.
     */
    'redis' => [
        'prefix_base' => 'tenant', // Each key in Redis will be prepended by this prefix_base, followed by the tenant id.
        'prefixed_connections' => [ // Redis connections whose keys are prefixed, to separate one tenant's keys from another.
            // 'default',
        ],
    ],

    'configurationer' => [
        
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
    ]
];
