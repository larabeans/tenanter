<?php

namespace App\Containers\Vendor\Tenanter\Bootstrappers;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Facades\Redis;
use App\Containers\Vendor\Tenanter\Contracts\TenancyBootstrapper;
use App\Containers\Vendor\Tenanter\Contracts\Tenant;

class RedisTenancyBootstrapper implements TenancyBootstrapper
{
    /** @var array<string, string> Original prefixes of connections */
    public $originalPrefixes = [];

    /** @var Repository */
    protected $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    public function bootstrap(Tenant $tenant)
    {
        foreach ($this->prefixedConnections() as $connection) {
            $prefix = $this->config['tenanter.redis.prefix_base'] . $tenant->getTenantKey();
            $client = Redis::connection($connection)->client();

            $this->originalPrefixes[$connection] = $client->getOption($client::OPT_PREFIX);
            $client->setOption($client::OPT_PREFIX, $prefix);
        }
    }

    public function revert()
    {
        foreach ($this->prefixedConnections() as $connection) {
            $client = Redis::connection($connection)->client();

            $client->setOption($client::OPT_PREFIX, $this->originalPrefixes[$connection]);
        }

        $this->originalPrefixes = [];
    }

    protected function prefixedConnections()
    {
        return $this->config['tenanter.redis.prefixed_connections'];
    }
}
