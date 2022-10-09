<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_name',
        'emp_email',
        'emp_phone',
        'emp_joined_at',
        'emp_route',
        'emp_comment',
    ];
}
