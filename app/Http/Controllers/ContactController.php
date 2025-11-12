<?php

namespace App\Http\Controllers;

class ContactController extends Controller
{
    public function __invoke()
    {
        seo()->title('Kontakt');

        return inertia('Contact');
    }
}
