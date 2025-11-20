<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __invoke()
    {
        seo()->title('Úvodní stránka');

        return inertia('Home');
    }
}
