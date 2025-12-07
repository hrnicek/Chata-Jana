<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactFormMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;

class ContactsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(): Response
    {
        return inertia('Contact');
    }

    public function store(ContactFormRequest $request): RedirectResponse
    {
        Mail::to('info@chata-jana.cz')->send(new ContactFormMail($request->validated()));

        return back()->with('success', 'Vaše zpráva byla úspěšně odeslána. Brzy se vám ozveme.');
    }
}
