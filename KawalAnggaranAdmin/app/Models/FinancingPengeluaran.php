<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancingPengeluaran extends Model
{
    protected $table = 'financing_pengeluaran';

    protected $primaryKey = 'id'; // Adjust primary key if necessary

    public $timestamps = false; // Disable automatic timestamps handling

    protected $fillable = [
        'pengeluaran_daerah', 'anggaran', 'realisasi', 'MONTH', 'YEAR',
    ];
}