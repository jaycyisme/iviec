@props(['title' => 'Xác nhận mật khẩu', 'content' => 'Vì lý do bảo mật, hệ thống muốn xác nhận lại mật khẩu của bạn', 'button' => 'Xác nhận'])

@php
    $confirmableId = md5($attributes->wire('then'));
@endphp

<span
    {{ $attributes->wire('then') }}
    x-data
    x-ref="span"
    x-on:click="$wire.startConfirmingPassword('{{ $confirmableId }}');"
    x-on:password-confirmed.window="setTimeout(() => $event.detail.id === '{{ $confirmableId }}' && $refs.span.dispatchEvent(new CustomEvent('then', { bubbles: false })), 250);"
>
    {{ $slot }}
</span>

@once
<x-dialog-modal wire:model.live="confirmingPassword">
    <x-slot name="title">
        <strong>{{ $title }}</strong>
    </x-slot>

    <x-slot name="content">
        <p>{{ $content }}</p>

        <div x-data="{}" x-on:confirming-password.window="setTimeout(() => $refs.confirmable_password.focus(), 250)">
            <x-input type="password" placeholder="Mật khẩu..." autocomplete="current-password" x-ref="confirmable_password" wire:model="confirmablePassword" wire:keydown.enter="confirmPassword" />
            <x-input-error for="confirmable_password" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button class="btn-danger" wire:click="stopConfirmingPassword" wire:loading.attr="disabled" data-bs-dismiss="modal">
            Hủy
        </x-secondary-button>

        <x-button class="btn-info" dusk="confirm-password-button" wire:click="confirmPassword" wire:loading.attr="disabled">
            {{ $button }}
        </x-button>
    </x-slot>
</x-dialog-modal>
@endonce
