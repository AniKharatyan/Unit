<?php

namespace App\Services;

use App\Models\Unit;
use App\Resources\UnitResource;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Read\UnitReadRepositoryInterface;
use App\Repositories\Write\UnitWriteRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SyncUnitAction
{
    protected Collection|array $dbUnits;

    protected array $unitNumbers = [];

    protected array $dbNumbers = [];

    public function __construct(
        protected UnitReadRepositoryInterface $unitReadRepository,
        protected UnitWriteRepositoryInterface $unitWriteRepository,
    ) {}

    public function run(array $units): AnonymousResourceCollection
    {
        $this->init();

        if ($this->dbUnits->isEmpty()) {
            $this->staticCreate($units);

            return $this->generateResponse();
        }

        $this->changeToAvailable($units);

        $this->changeToSoldOut($units);

        $this->createUnit($units);

        return $this->generateResponse();
    }

    private function init(): void
    {
        $this->dbUnits = $this->unitReadRepository->index();
    }

    private function staticCreate(array $units): void
    {
        foreach ($units as $data) {
            $newUnit = Unit::staticCreate($data['number'], $data['price']);

            $this->unitWriteRepository->save($newUnit);
        }

    }

    private function changeToAvailable(array $units): void
    {
        foreach ($units as $unit) {
            $data = $this->unitReadRepository->getByNumber($unit['number']);

            if (!is_null($data)) {
                $this->unitWriteRepository->update($data->number, $unit['price']);
            }
        }
    }

    private function changeToSoldOut(array $units): void
    {
        if ($this->dbUnits->isEmpty()) {
            $this->createUnit($units);
            return;
        }

        $this->unitNumbers = array_column($units, 'number');

        $this->dbNumbers = array_column($this->dbUnits->toArray(), 'number');

        $notReceived = array_diff($this->dbNumbers, $this->unitNumbers);

        $this->unitWriteRepository->changeStatus($notReceived);
    }

    private function createUnit(array $units): void
    {
        $unitsToCreate = array_diff($this->unitNumbers, $this->dbNumbers);

        if ($unitsToCreate) {
            $filteredData = array_filter($units, function ($item) use ($unitsToCreate) {
                return in_array($item['number'], $unitsToCreate);
            });

            $this->staticCreate($filteredData);
        }
    }

    private function generateResponse(): AnonymousResourceCollection
    {
        $units = $this->unitReadRepository->index();

        return UnitResource::collection($units);
    }
}
