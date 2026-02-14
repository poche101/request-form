<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ITRequest extends Model
{
    // Explicitly define the table name to match your migration
    protected $table = 'it_requests';

    protected $fillable = [
        'full_name',
        'email',
        'department',
        'title',
        'description',
        'status',
        'priority',
        'attachment'
    ];
}
