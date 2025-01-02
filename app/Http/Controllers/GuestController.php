<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class GuestController extends Controller
{

    public function about()
    {
        return Inertia::render('Guest/About');
    }

    public function privacyPolicy()
    {
        return Inertia::render('Guest/PrivacyPolicy');
    }

    public function termsAndConditions()
    {
        return Inertia::render('Guest/TermsAndConditions');
    }
}
