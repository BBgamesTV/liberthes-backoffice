<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoyenPaiement extends Model
{
    protected $fillable = ['nom'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
