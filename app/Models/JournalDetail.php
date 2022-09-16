<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalDetail extends Model
{
    protected $fillable = [
        'state',
        'journal_header_id',
        'process_id',
        'operation_hours',
    ];
}
