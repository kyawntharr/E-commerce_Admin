<div class="mb-3">
    <label for="{{ $name }}" class="form-label">
        @php
            echo \Illuminate\Support\Str::ucfirst($cn ?? $name);
        @endphp
    </label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        class="form-control rounded-0 shadow-none @if ($errors->has($name)) is-invalid @endif"
        aria-describedby="{{ $name }}Help" value="{{ $value ?? old($name) }}" {{ $m ?? '' }}>
    @error($name)
        <div id="{{ $name }}Help" class="form-text text-danger">{{ $errors->first($name) }}</div>
    @enderror
</div>
