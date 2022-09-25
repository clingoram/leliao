<?php

namespace App\Http\Controllers\Cookie;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Cookie;
// use Illuminate\Support\Facades\Cookie;

/**
 * set and get cookie.
 */
class CookieController extends Controller
{
    protected $info;
    // public function setCookie(String $name)
    // {
    //     $minutes = 10;
    //     // Cookie::queue('key', $name, $minutes);
    //     // cookie('name', 'value', $minutes);

    //     return response('Hello World')->withCookie(cookie(
    //         'name',
    //         $name,
    //         $minutes
    //     ));
    // }
    // public function getCookie(Request $request)
    // {
    //     // return $name->cookie('key');
    //     // return  Cookie::get('key');
    //     // return response()->cookie(Cookie::get('key'));
    //     return $request->cookie('name');
    // }

    public function setCookie(Request $request)
    {
        $minutes = 1;
        $response = new Response('Hello World');
        $response->withCookie(cookie('name', 'virat', $minutes));
        return $response;
    }
    public function getCookie(Request $request)
    {
        $value = $request->cookie('name');
        echo $value;
    }
}
