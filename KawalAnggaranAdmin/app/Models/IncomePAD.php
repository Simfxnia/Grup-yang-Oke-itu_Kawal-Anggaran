<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomePAD extends Model
{
    protected $table = 'income_PAD'; // Adjust table name if necessary

    protected $primaryKey = 'id'; // Adjust primary key if necessary

    public $timestamps = false; // Disable automatic timestamps handling

    protected $fillable = [
        'PAD', 'anggaran', 'realisasi', 'MONTH', 'YEAR',
    ];
}
