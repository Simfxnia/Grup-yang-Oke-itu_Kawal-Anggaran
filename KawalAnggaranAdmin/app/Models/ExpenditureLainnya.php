<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenditureLainnya extends Model
{
    protected $table = 'expenditure_lain';

    protected $primaryKey = 'id'; // Adjust primary key if necessary

    public $timestamps = false; // Disable automatic timestamps handling

    protected $fillable = [
        'expenditure_lainnya', 'anggaran', 'realisasi', 'MONTH', 'YEAR',
    ];
}
