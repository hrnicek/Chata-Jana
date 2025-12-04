<?php

namespace App\Http\Controllers;

class GalleryController extends Controller
{
    public function __invoke()
    {
        seo()->title('Fotogalerie');

        return inertia('Gallery');
    }
}