<?php

namespace App\Repositories\Write;

use App\Exceptions\SavingErrorException;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Builder;

class UnitWriteRepository implements UnitWriteRepositoryInterface
{
    private function query(): Builder
    {
        return Unit::query();
    }

    public function update(string $number, int $price): int
    {
        return $this->query()
            ->where('number', $number)
            ->update([
                'status' => 'available',
                'price' => $price
            ]);
    }

    public function changeStatus(array $numbers): int
    {
        return $this->query()
            ->whereIn('number', $numbers)
            ->update(['status' => 'sold_out']);
    }

    public function save(Unit $unit): bool
    {
        if (!$unit->save()) {
            throw new \Exception('Saving error');
        }

        return true;
    }
}
