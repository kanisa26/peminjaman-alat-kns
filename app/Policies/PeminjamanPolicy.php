<?php

namespace App\Policies;

use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Enums\StatusPeminjaman;

class PeminjamanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Peminjaman $peminjaman): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $pengguna, Peminjaman $peminjaman): bool
    {
        return $pengguna->can('peminjaman.kelola');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $pengguna, Peminjaman $peminjaman): bool
    {
        if (! $pengguna->can('peminjaman.kelola')) {
            return false;
        }

        return in_array($peminjaman->status, [
            StatusPeminjaman::Diajukan,
            StatusPeminjaman::Ditolak,
        ], true);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Peminjaman $peminjaman): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Peminjaman $peminjaman): bool
    {
        return false;
    }
}
