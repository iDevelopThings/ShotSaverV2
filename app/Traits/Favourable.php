<?php


namespace App\Traits;


use App\File;
use App\FileFavourite;

trait Favourable
{
    /**
     * Allow the authed user to "favourite" a file
     *
     * @return bool
     */
    public function favourite()
    {
        $favourite = FileFavourite::where('user_id', auth()->id())
            ->where('file_id', $this->id)
            ->first();

        if ($favourite !== null) {
            $favourite->delete();

            return false;
        } else {
            $favourite          = new FileFavourite;
            $favourite->user_id = auth()->id();
            $favourite->file_id = $this->id;
            $favourite->save();

            return true;
        }
    }

    public function hasFavourited()
    {
        $favourite = FileFavourite::where('user_id', auth()->id())
            ->where('file_id', $this->id)
            ->first();

        return $favourite;
    }
}
