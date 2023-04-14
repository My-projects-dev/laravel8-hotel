<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (!in_array($request->language, config('translatable.locales'))) {
            $base = url()->to('');
            $segments = $request->segments();

            return redirect()->to($base . '/' . config('app.locale') . '/' . implode('/', $segments));
        }

        Session::put('language', $request->language);
        App::setLocale(Session::get('language'));

        return $next($request);
    }
}
