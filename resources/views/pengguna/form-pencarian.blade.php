<form
    method="GET"
    action="{{ route('pengguna.index') }}"
    class="row g-2"
>

    {{-- CARI --}}
    <div class="col-md-6">

        <input
            type="text"
            name="cari"
            class="form-control"
            placeholder="Cari nama atau nama pengguna"
            value="{{ $kataKunci }}"
        >

    </div>


    {{-- PERAN --}}
    <div class="col-md-3">

        <select
            name="peran"
            class="form-select"
        >

            <option value="">
                Semua Peran
            </option>

            @foreach ($daftarPeran as $pilihanPeran)

                <option
                    value="{{ $pilihanPeran->name }}"
                    {{ $peran == $pilihanPeran->name ? 'selected' : '' }}
                >
                    {{ ucfirst($pilihanPeran->name) }}
                </option>

            @endforeach

        </select>

    </div>


    {{-- BUTTON --}}
    <div class="col-auto">

        <button
            type="submit"
            class="btn btn-primary btn-filter-pengguna"
        >
            Cari
        </button>


        <a
            href="{{ route('pengguna.index') }}"
            class="btn btn-secondary btn-filter-pengguna"
        >
            Reset
        </a>

    </div>

</form>