@props(['submit'])
<div {{ $attributes->merge(['class' => '']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
    </x-section-title>

    <div class="card-body">
        <div class="row">
            {{ $actionnotification }}
        </div>

        <form wire:submit="{{ $submit }}">
            {{ $form }}
            
            <div class="row mt-3">
                @if (isset($actions))
                    {{ $actions }}
                @endif
            </div>
        </form>
    </div>
</div>
