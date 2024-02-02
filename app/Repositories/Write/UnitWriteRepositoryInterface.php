<?php

namespace App\Repositories\Write;

use App\Models\Unit;

interface UnitWriteRepositoryInterface
{
    public function update(string $number, int $price): int;
    public function changeStatus(array $numbers): int;
    public function save(Unit $unit);
}
