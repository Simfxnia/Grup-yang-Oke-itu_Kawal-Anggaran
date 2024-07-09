<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenditureBj extends Model
{
    protected $table = 'expenditure_bj';

    protected $primaryKey = 'id'; // Adjust primary key if necessary

    public $timestamps = false; // Disable automatic timestamps handling

    protected $fillable = [
        'barang_jasa', 'anggaran', 'realisasi', 'MONTH', 'YEAR',
    ];
}