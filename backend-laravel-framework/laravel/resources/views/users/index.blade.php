<x-app-layout>
    <x-slot name="pageHeader">
        Quản lý người dùng
    </x-slot>

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Danh sách</h5>
            </div>
            <div class="card-body table-border-style">
                @livewire('users-table')
            </div>
        </div>
    </div>
</x-app-layout>