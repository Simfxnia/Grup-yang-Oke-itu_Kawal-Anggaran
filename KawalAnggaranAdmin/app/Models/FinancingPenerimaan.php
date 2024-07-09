<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancingPenerimaan extends Model
{
    protected $table = 'financing_penerimaan';

    protected $primaryKey = 'id'; // Adjust primary key if necessary

    public $timestamps = false; // Disable automatic timestamps handling

    protected $fillable = [
        'penerimaan_daerah', 'anggaran', 'realisasi', 'MONTH', 'YEAR',
    ];
}