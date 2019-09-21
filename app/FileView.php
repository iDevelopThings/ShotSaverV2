<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileView extends Model
{
    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
