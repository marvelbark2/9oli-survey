<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moocs extends Model
{
    protected $guarded = [''];
    public function survey()
    {
        return $this->hasMany('MattDaneshvar\Survey\Models\Survey', 'moocs_id', 'id');
    }
}
