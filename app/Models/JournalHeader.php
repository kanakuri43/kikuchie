<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalHeader extends Model
{
    protected $fillable = [
        'state',
        'operation_date',
        'author_id',
    ];
}
