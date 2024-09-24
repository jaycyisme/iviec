<div {{ $attributes->merge(['class' => '']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
    </x-section-title>

    <div class="card-body">
        {{ $content }}
    </div>
</div>