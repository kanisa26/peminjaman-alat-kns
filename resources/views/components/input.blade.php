@props([
    'name',
    'label',
    'type' => 'text',
    'value' => '',
    'wajib' => false,
])

<div class="mb-3">

    <label for="{{ $name }}" class="form-label">
        {{ $label }}

        @if ($wajib)
            <span class="text-danger">*</span>
        @endif
    </label>

    <input
        id="{{ $name }}"
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        class="form-control @error($name) is-invalid @enderror"
        {{ $attributes }}
    >

    @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror

</div>