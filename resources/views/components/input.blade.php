@props(['name', 'label', 'type' => 'text', 'value' => ''])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
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
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>