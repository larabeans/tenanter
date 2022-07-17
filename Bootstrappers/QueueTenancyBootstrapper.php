<?php

namespace App\Containers\Larabeans\Tenanter\Bootstrappers;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Queue\QueueManager;
use Illuminate\Support\Testing\Fakes\QueueFake;
use App\Containers\Larabeans\Tenanter\Contracts\TenancyBootstrapper;
use App\Containers\Larabeans\Tenanter\Contracts\Tenant;

class QueueTenancyBootstrapper implements TenancyBootstrapper
{
    /** @var Repository */
    protected $config;

    /** @var QueueManager */
    protected $queue;

    /**
     * The normal constructor is only executed after tenancy is bootstrapped.
     * However, we're registering a hook to initialize tenancy. Therefore,
     * we need to register the hook at service provider execution time.
     */
    public static function __constructStatic(Application $app)
    {
        static::setUpJobListener($app->make(Dispatcher::class));
    }

    public function __construct(Repository $config, QueueManager $queue)
    {
        $this->config = $config;
        $this->queue = $queue;

        $this->setUpPayloadGenerator();
    }

    protected static function setUpJobListener($dispatcher)
    {
        $dispatcher->listen(JobProcessing::class, function ($event) {
            $tenantId = $event->job->payload()['tenant_id'] ?? null;

            // The job is not tenant-aware
            if (! $tenantId) {
                return;
            }

            // Tenancy is already initialized for the tenant (e.g. dispatchNow was used)
            if (tenancy()->initialized && tenancy()->tenantInitialized && tenant()->getTenantKey() === $tenantId) {
                return;
            }

            // Tenancy was either not initialized, or initialized for a different tenant.
            // Therefore, we initialize it for the correct tenant.
            tenancy()->initializeTenant(tenancy()->findTenant($tenantId));
        });
    }

    protected function setUpPayloadGenerator()
    {
        $bootstrapper = &$this;

        if (! $this->queue instanceof QueueFake) {
            $this->queue->createPayloadUsing(function ($connection) use (&$bootstrapper) {
                return $bootstrapper->getPayload($connection);
            });
        }
    }

    public function bootstrap(Tenant $tenant)
    {
        //
    }

    public function revert()
    {
        //
    }

    public function getPayload(string $connection)
    {
        if (! tenancy()->initialized || ! tenancy()->tenantInitialized ) {
            return [];
        }

        if ($this->config["queue.connections.$connection.central"]) {
            return [];
        }

        $id = tenant()->getTenantKey();

        return [
            'tenant_id' => $id,
        ];
    }
}
