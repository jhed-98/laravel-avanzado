<?php

namespace App\View\Composers;

use Illuminate\View\View;

class CompanyComposer
{
    public function compose(View $view): void
    {
        $view->with('company', "Este es un mensaje de un composer company");
    }
}
