<?php


namespace App\Traits;


use App\FileView;

trait Viewable
{

    /**
     * Save a new view for the current person viewing this file
     */
    public function saveView()
    {
        if ($this->views()->whereIp(request()->ip())->first()) {
            return;
        }

        $view     = new FileView;
        $view->ip = request()->ip();

        $this->views()->save($view);
    }

}
