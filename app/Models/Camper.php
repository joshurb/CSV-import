<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Camper extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'camper_make',
        'camper_brand',
        'sleep_number',
        'price'
    ];

    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    public function model(array $row)
    {
        return new Camper([
            'camper_make' => $row[0],
            'camper_brand' => $row[1],
            'sleep_number' => $row[2],
            'price' => $row[3],
        ]);
    }

}
