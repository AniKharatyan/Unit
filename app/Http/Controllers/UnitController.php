<?php

namespace App\Http\Controllers;

use App\Services\SyncUnitAction;
use App\Http\Requests\SyncUnitRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UnitController extends Controller
{
    public function __construct(
        protected SyncUnitAction $syncUnitAction
    ) {}

    public function sync(SyncUnitRequest $request): AnonymousResourceCollection
    {
        return $this->syncUnitAction->run($request->getUnit());
    }
}
