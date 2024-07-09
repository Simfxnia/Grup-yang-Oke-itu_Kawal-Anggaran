<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeTKDD extends Model
{
    protected $table = 'income_TKDD';

    protected $primaryKey = 'id'; // Adjust primary key if necessary

    public $timestamps = false; // Disable automatic timestamps handling

    protected $fillable = [
        'TKDD', 'anggaran', 'realisasi', 'MONTH', 'YEAR',
    ];
}