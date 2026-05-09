<?php

Route::get('/greeting/{name}', function ($name) { return 'Hello '.$name;});
