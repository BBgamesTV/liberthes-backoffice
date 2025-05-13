<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'type',
        'libelle',
        'montant',
        'date',
        'moyen_paiement',
        'note',
    ];
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function moyenPaiement()
    {
        return $this->belongsTo(MoyenPaiement::class);
    }
}
