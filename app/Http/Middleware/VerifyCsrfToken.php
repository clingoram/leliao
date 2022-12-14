<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

// add
use Symfony\Component\HttpFoundation\Cookie;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // add
        // 'api/*',
        // 'sub.domain.zone' => [
        //     // 'prefix/*'
        //     '/lel/*'
        // ],
    ];


    // add
    protected function addCookieToResponse($request, $response)
    {
        $response->headers->setCookie(
            new Cookie(
                'XSRF-TOKEN',
                $request->session()->token(),
                time() + 60 * 120,
                '/; samesite=strict',
                null,
                config('session.secure'),
                true
            )
        );
        return $response;
    }
}
