<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenditurePegawai extends Model
{
    protected $table = 'expenditure_pegawai';

    protected $primaryKey = 'id'; // Adjust primary key if necessary

    public $timestamps = false; // Disable automatic timestamps handling

    protected $fillable = [
        'belanja_pegawai', 'anggaran', 'realisasi', 'MONTH', 'YEAR',
    ];
}