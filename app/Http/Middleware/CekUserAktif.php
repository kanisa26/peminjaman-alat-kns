<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekUserAktif
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {

            $user = auth()->user();

            // Jika belum aktif
            if (!$user->is_aktif) {

                // Halaman yang masih boleh diakses
                if (
                    $request->routeIs('admin.dasbor') ||
                    $request->routeIs('petugas.dasbor') ||
                    $request->routeIs('peminjam.dasbor') ||
                    $request->routeIs('profil.*') ||
                    $request->routeIs('logout')
                ) {
                    return $next($request);
                }

                return redirect()->route('admin.dasbor')
                    ->with('gagal', 'Akun Anda masih menunggu validasi.');
            }
        }

        return $next($request);
    }
}