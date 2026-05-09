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
        echo $url = $request->path();

        //"is" method allows you to verify that the incoming request path matches
        if ($request->is('invokable/*')) {
            echo "<br> Yes  it is invokable";
        }

        //Using the routeIs method, you may determine if the incoming request has matched a named route:
        if ($request->routeIs('admin.*')) {
            // ...
        }

        echo "<br>".$url = $request->url();
        echo "<br>".$urlwithQueryString = $request->fullUrl();
        //add query string to the url
        echo "<br>".$request->fullUrlWithQuery(['type' => 'phone']);
        //remove query string from request url
        echo "<br>".$request->fullUrlWithoutQuery(['type']);

        // http://localhost:8000
        echo "<br>".$request->host(); // localhost
        echo "<br>".$request->httpHost(); // localhost:8000
        echo "<br>".$request->schemeAndHttpHost(); // http://localhost:8000

        echo "<br>".$ipAddress = $request->ip();
        $ipAddresses = $request->ips();
        print_r($ipAddresses);
        $contentTypes = $request->getAcceptableContentTypes();
        echo "<br>";
        print_r($contentTypes);
        if ($request->accepts(['text/html', 'application/json'])) {
            echo "<br> Yes it accepts html and json";
        }

        $preferred = $request->prefers(['text/html', 'application/json']);
        echo "<br>";
        print_r($preferred);


        if ($request->expectsJson()) {
            echo "<br> Yes it accepts json";
        }

        $input = $request->all();
        echo "<br>";
        print_r($input);
        $collect = $request->collect(); //return object instance Illuminate\Support\Collection
        echo "<br>";
        print_r($collect->get('name'));
        $request->merge(['age' => 'twenty']);
        $query = $request->query();
        echo "<br>";
        print_r($query);

        //echo $request->input('age');
        dd($request);
        return "One Principal Controller to run complex logic or generating huge report.";
    }
}
