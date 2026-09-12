@props([
    'name' => null,
    'label' => null,
    'opsi' => [],
    'value' => null,
    'keyValue' => 'key',
    'keyLabel' => 'label',
    'placeholder' => null,
    'wajib' => false,
])

<div class="mb-3">

    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}

            @if ($wajib)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <select
        class="form-select @error($name) is-invalid @enderror"
        id="{{ $name }}"
        name="{{ $name }}"
        @if ($wajib) required @endif
    >

        @if ($placeholder)
            <option value="">
                {{ $placeholder }}
            </option>
        @endif

        @foreach ($opsi as $pilihan)

            @php
                $nilai = $pilihan[$keyValue];
                $teks = $pilihan[$keyLabel];
            @endphp

            <option
                value="{{ $nilai }}"
                {{ (string) old($name, $value) === (string) $nilai ? 'selected' : '' }}
            >
                {{ $teks }}
            </option>

        @endforeach

    </select>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>