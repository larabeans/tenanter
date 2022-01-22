<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Tenanter\Data\Repositories\HostRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Parents\Exceptions\Exception;
use Illuminate\Database\Eloquent\Builder;

class GetHostPrimaryDomainsTask extends Task
{
    protected HostRepository $repository;

    public function __construct(HostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        try {
            /** @var Host|null $host */
            $host = config('tenanter.models.host')::query()
                ->whereHas('domains', function (Builder $query) {
                    $query->where('is_primary', true);
                })
                ->with('domains')
                ->first();

            return $host->domains();
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
