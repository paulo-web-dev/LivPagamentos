<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserPower
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Verificar se o usuário está autenticado e se possui o campo 'power'
        if ($user) {
            if ($user->power == 0) {
                // Redireciona para a rota 'home' se o power for 0
                return redirect()->route('home');
            } elseif ($user->power == 1) {
                // Redireciona para a rota 'livcard-home' se o power for 1
                return redirect()->route('livcard-home');
            }
        }

        return $next($request);
    }
}
