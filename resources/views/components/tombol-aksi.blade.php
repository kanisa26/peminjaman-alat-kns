@props([
    'lihat' => null,
    'ubah' => null,
    'hapus' => null,
    'pesanHapus' => 'Yakin ingin menghapus data ini?',
    'role' => null,
])

<style>
    .aksi-wrapper {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .btn-aksi {
        width: 42px;
        height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #ffffff;
        transition: all 0.2s ease;
        text-decoration: none;
        padding: 0;
    }

    .btn-aksi svg {
        width: 20px;
        height: 20px;
    }

    /* TOMBOL UBAH */
    .btn-ubah {
        border: 1px solid #f6d365;
        color: #e9a900;
        background: #fff9df;
    }

    .btn-ubah:hover {
        color: #d99600;
        background: #fff3c2;
        border-color: #f1c84b;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(234, 179, 8, 0.15);
    }

    /* TOMBOL HAPUS */
    .btn-hapus {
        border: 1px solid #f3a4a4;
        color: #ef4444;
        background: #fff5f5;
        cursor: pointer;
    }

    .btn-hapus:hover {
        color: #dc2626;
        background: #ffe4e4;
        border-color: #ef8d8d;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(239, 68, 68, 0.15);
    }
</style>

<div class="aksi-wrapper">

    {{-- TOMBOL LIHAT --}}
    @if ($lihat)
        <a href="{{ $lihat }}"
           class="btn-aksi"
           title="Lihat"
           aria-label="Lihat">

            <svg xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round">

                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                <circle cx="12" cy="12" r="3"/>

            </svg>

        </a>
    @endif


    {{-- TOMBOL UBAH --}}
    @if ($ubah)
        <a href="{{ $ubah }}"
           class="btn-aksi btn-ubah"
           title="Ubah"
           aria-label="Ubah">

            <svg xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round">

                <path d="M12 20h9"/>

                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"/>

            </svg>

        </a>
    @endif


    {{-- TOMBOL HAPUS --}}
    {{-- ADMIN TIDAK BOLEH MELIHAT TOMBOL HAPUS --}}
    @if ($hapus && strtolower($role) !== 'admin')

        <form action="{{ $hapus }}"
              method="POST"
              class="d-inline"
              onsubmit="return confirm('{{ $pesanHapus }}')">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="btn-aksi btn-hapus"
                    title="Hapus"
                    aria-label="Hapus">

                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round">

                    <path d="M3 6h18"/>

                    <path d="M8 6V4h8v2"/>

                    <path d="M19 6l-1 14H6L5 6"/>

                    <path d="M10 11v5"/>

                    <path d="M14 11v5"/>

                </svg>

            </button>

        </form>

    @endif

</div>