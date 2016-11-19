<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class submission extends Model
{
    // We need to know when it was created, the update time is a bonus.
    public $timestamps = true;
}
