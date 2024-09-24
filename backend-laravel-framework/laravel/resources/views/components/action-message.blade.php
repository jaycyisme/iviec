@props(['on'])

<div role="alert"
    x-data="{ shown: false, timeout: null }"
    x-init="@this.on('{{ $on }}', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); })"
    x-show.transition.out.opacity.duration.1500ms="shown"
    x-transition:leave.opacity.duration.1500ms 
    style="display: none" 
    {!! $attributes->merge(['class' => 'alert alert-primary']) !!}>
    {{ $slot->isEmpty() ? 'Đã lưu.' : $slot }}
</div>