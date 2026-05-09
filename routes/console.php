<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::Command('test', function () {
    $this->info('This is a test command. It does not perform any actions but serves as an example of how to create a custom Artisan command in Laravel.');
})->purpose('Display an test command text.');
