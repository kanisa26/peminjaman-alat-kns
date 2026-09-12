<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Responses\LoginResponse;
use App\Models\LogAktivitas;
use App\Models\User;
use Laravel\Fortify\Contracts\LoginResponse as KontrakLoginResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            KontrakLoginResponse::class,
            LoginResponse::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::username('username');

        Fortify::authenticateUsing(function (Request $request) {

            // Cari pengguna berdasarkan username
            $pengguna = User::where(
                'username',
                $request->username
            )->first();

            // Username tidak ditemukan / password salah
            if (
                !$pengguna ||
                !Hash::check(
                    $request->password,
                    $pengguna->password
                )
            ) {
                $this->catatLogGagal($request);

                return null;
            }

            /*
            |--------------------------------------------------------------------------
            | VALIDASI AKUN
            |--------------------------------------------------------------------------
            */

/*
|--------------------------------------------------------------------------
| CEK ROLE DAN VALIDASI AKUN
|--------------------------------------------------------------------------
*/

$isAdmin = $pengguna->hasRole('admin');

// ADMIN langsung boleh login
if (!$isAdmin) {

    // Pengguna yang belum divalidasi / sudah dinonaktifkan
    if (!$pengguna->is_aktif) {
        throw ValidationException::withMessages([
            'username' =>
                'Akun Anda belum divalidasi atau sedang dinonaktifkan. Silakan hubungi administrator.'
        ]);
    }
}

            /*
            |--------------------------------------------------------------------------
            | LOGIN BERHASIL
            |--------------------------------------------------------------------------
            */

            LogAktivitas::create([
                'user_id' => $pengguna->id,
                'aksi' => 'login',
                'tabel_tujuan' => 'users',
                'deskripsi' =>
                    'Pengguna ' .
                    $pengguna->username .
                    ' berhasil masuk.',
                'ip_address' => $request->ip(),
            ]);

            return $pengguna;
        });

        /*
        |--------------------------------------------------------------------------
        | RATE LIMIT LOGIN
        |--------------------------------------------------------------------------
        */

        RateLimiter::for('login', function (Request $request) {

            $username = $request->username;

            return Limit::perMinute(5)->by(
                $username . '|' . $request->ip()
            );
        });
    }

    /**
     * Catat percobaan login gagal.
     */
    private function catatLogGagal(
        Request $request,
        ?int $penggunaId = null
    ): void {
        LogAktivitas::create([
            'user_id' => $penggunaId,
            'aksi' => 'login_gagal',

            // PERHATIKAN: tabel_tujuan, bukan table_tujuan
            'tabel_tujuan' => 'users',

            'deskripsi' =>
                'Percobaan masuk gagal untuk username ' .
                $request->username,

            'ip_address' => $request->ip(),
        ]);
    }
}