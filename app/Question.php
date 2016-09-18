<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // Pas besoin de sauvegarder la date de création et de mise à jour

    public $timestamps = false;
}
