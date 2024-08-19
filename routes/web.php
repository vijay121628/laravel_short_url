<?php

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('url_shortner');
});

Route::post('/', function (Request $request) {
    $rules = array(
        'link' => 'required|url'
    );

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return  Redirect::to('/')->withErrors($validator);
    } else {

        $link = Link::where('link', $request->input('link'))->first();

        if ($link) {
            return Redirect::to('/')->with(['link' => $link->hash]);
        } else {

            do {

                $newHash = Str::random(6);
            } while (Link::where('hash', $newHash)->count() > 0);

            Link::create(array(
                'link' => $request->input('link'),
                'hash' => $newHash,
            ));

            return Redirect::to('/')->with(['link' => $newHash]);
        }
    }
});

Route::get('/{hash}', function ($hash) {

    $urlData = Link::where('hash', $hash)->first();

    if ($urlData) {
        return Redirect::to($urlData->link);
    } else {
        return Redirect::to('/')->with(['invalidURL' => 'Invalid URL']);
    }
});
