<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = ['name', 'code', 'description', 'quantity'];

    public function loans()
    {
        return $this->hasMany(AssetLoan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
