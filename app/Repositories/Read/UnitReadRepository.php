<?php

namespace App\Repositories\Read;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class UnitReadRepository implements UnitReadRepositoryInterface
{
    private function query(): Builder
    {
        return Unit::query();
    }

    public function getByNumber(string $number)
    {
        return $this->query()
            ->where('number', $number)
            ->where('status', 'sold_out')
            ->first();
    }

    public function index(): Collection|array
    {
        return $this->query()->get();
    }
}
