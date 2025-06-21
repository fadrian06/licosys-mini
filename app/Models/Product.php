<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read float $unit_price
 * @property-read ?float $revenue
 */
class Product extends Model
{
  protected $fillable = [
    'name',
    'unit_price',
    'revenue',
  ];
}
