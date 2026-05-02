<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnePrincipalController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return "One Principal Controller to run complex logic or generating huge report.";
    }
}
