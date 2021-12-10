<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Models\Domain;
use App\Containers\Vendor\Tenanter\Tasks\UpdateDomainTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\VerifyDomainRequest;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Carbon;

class VerifyDomainAction extends Action
{
    public function run(VerifyDomainRequest $request): Domain
    {
        $date = Carbon::parse($request->verification_date);
        return app(UpdateDomainTask::class)->run($request->id, [
            'verified_at'=>$date->format('Y-m-d H:i:s'),
            'is_verified' => true,

        ]);
    }
}
