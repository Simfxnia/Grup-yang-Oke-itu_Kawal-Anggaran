<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenditureModal extends Model
{
    protected $table = 'expenditure_modal';

    protected $primaryKey = 'id'; // Adjust primary key if necessary

    public $timestamps = false; // Disable automatic timestamps handling

    protected $fillable = [
        'modal', 'anggaran', 'realisasi', 'MONTH', 'YEAR',
    ];
}