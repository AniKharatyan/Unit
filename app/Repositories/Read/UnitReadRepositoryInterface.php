<?php

namespace App\Repositories\Read;

use Illuminate\Database\Eloquent\Collection;

interface UnitReadRepositoryInterface
{
    public function index(): Collection|array;
    public function getByNumber(string $number);
}
