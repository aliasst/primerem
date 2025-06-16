<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleStage extends Model
{



    public function sample_stages()
    {
        return $this->hasMany(SampleStage::class);
    }


}
