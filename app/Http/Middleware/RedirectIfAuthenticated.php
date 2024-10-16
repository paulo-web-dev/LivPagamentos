<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Obter o usuário autenticado
                $user = Auth::guard($guard)->user();

                // Verificar o valor do campo 'power'
                if ($user->power == 0) {
                    return redirect()->route('home'); // Redireciona para a rota home
                } elseif ($user->power == 1) {
                    return redirect()->route('livcard-home'); // Redireciona para a rota livcard-home
                }
            }
        }

        return $next($request);
    }
}
