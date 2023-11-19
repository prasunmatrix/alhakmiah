<?php
namespace App\Traits;

trait CommonVariables
{
    public function shareVariables() {
        \View::share([
            'projectSlug'         	=> $this->projectSlug ?? '',
            'communityDetailsSlug'  => $this->communityDetailsSlug ?? '',
        ]);
    }

}