<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeLainnya extends Model
{
    protected $table = 'income_lain';

    protected $primaryKey = 'id'; // Adjust primary key if necessary

    public $timestamps = false; // Disable automatic timestamps handling

    protected $fillable = [
        'income_lainnya', 'anggaran', 'realisasi', 'MONTH', 'YEAR',
    ];
}
