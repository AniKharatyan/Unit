<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $price
 * @property string $number
 * @property string $status
 */
class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';

    protected $fillable = [
        'number',
        'price',
        'status'
    ];

    public static function staticCreate(string $number, int $price): Unit
    {
        $unit = new self();

        $unit->setNumber($number);
        $unit->setPrice($price);
        $unit->setStatus('available');

        return $unit;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
