@props(['for'])

@error($for)
    <div class="invalid-feedback d-flex">{{ $message }}</div>
@enderror