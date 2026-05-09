<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class UrlGeneratorController extends Controller
{
    public function index() {
        return URL::signedRoute('unsubscribe', ['user' => '1']);
    }
}
