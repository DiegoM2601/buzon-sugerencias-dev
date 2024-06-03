<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIPMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     // return $next($request);
    //     $allowedIps = ['181.115.171.144', '127.0.0.1']; // Añade las IPs permitidas aquí
    //     if (!in_array($request->ip(), $allowedIps)) {
    //         // Redireccionar si la IP no está permitida
    //         // return redirect('ruta_a_tu_pagina_de_error');
    //         return redirect('/acceso-restringido');
    //     }

    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next)
    {
        // Lista de IPs específicas
        $allowedSpecificIps = [
            '127.0.0.1',
            '181.115.171.148',
        ];

        // Lista de rangos de IPs 
        $customRanges = [
            '186.121.254.57/62', // SCZ
            '186.121.246.153/158', // CBB
            '186.121.247.162/166', // EAT
            '186.121.247.154/158', // LPZ
        ];

        $allowedIps = array_merge($allowedSpecificIps, $this->expandCustomRanges($customRanges));

        // if (!in_array($request->ip(), $allowedIps)) {
        //     return redirect('/acceso-restringido');
        // }

        // if (in_array($request->ip(), $allowedIps)) {
        //     session(['access_granted' => true]);
        // } else {
        //     session(['access_granted' => false]);
        // }

        session(['access_granted' => true]);

        return $next($request);
    }

    /**
     * Expande los rangos personalizados a una lista de IPs.
     */
    private function expandCustomRanges(array $ranges)
    {
        $ips = [];
        foreach ($ranges as $range) {
            list($baseIp, $endPart) = explode('/', $range);
            list($a, $b, $c, $start) = explode('.', $baseIp);

            for ($i = $start; $i <= $endPart; $i++) {
                $ips[] = "{$a}.{$b}.{$c}.{$i}";
            }
        }

        return $ips;
    }
}