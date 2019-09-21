<?php

namespace App;

use App\Traits\Favourable;
use App\Traits\Viewable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use Viewable, Favourable;

    protected $guarded = ['id'];

    protected $casts = ['meta' => 'array'];

    public function views()
    {
        return $this->hasMany(FileView::class);
    }

    public function favourites()
    {
        return $this->hasMany(FileFavourite::class);
    }

    public function file($file)
    {
        if ($this->{$file} === null) {
            return null;
        }

        return Storage::cloud()->temporaryUrl($this->{$file}, now()->addMinutes(60));
    }

    public function codeFileContents()
    {
        if ($this->type !== 'code') {
            throw new \Exception('This file is not a code file.');
        }

        return Storage::cloud()->get($this->hd);

    }

    function formatSizeUnits()
    {
        $bytes = $this->size_in_bytes;

        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

}
