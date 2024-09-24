@props(['id'])

@php
$id = $id ?? md5($attributes->wire('model'));
@endphp

<div class="mt-3" 
    x-data="{ show: @entangle($attributes->wire('model')) }" 
    x-on:close.stop="show = false" 
    x-on:keydown.escape.window="show = false" 
    x-show="show" 
    id="{{ $id }}" 
    class="jetstream-modal" 
    style="display: none;">
    
    <div x-show="show" x-trap.inert.noscroll="show">
        <div id="{{ $id }}" class="modal fade show d-block" tabindex="-1" role="dialog" aria-labelledby="{{ $id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="{{ $id }}">{{ $title }}</h5>
                    </div>
                    <div class="modal-body">
                        {{ $content }}
                    </div>
                    <div class="modal-footer">
                        {{ $footer }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>