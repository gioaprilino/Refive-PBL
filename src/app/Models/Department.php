<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    protected $fillable = [
        'code',
        'name',
    ];
}



