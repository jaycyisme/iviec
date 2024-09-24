<x-app-layout>
    <x-slot name="pageHeader">
        Quản lý quyền
    </x-slot>

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h5>Danh sách</h5>
                @can('permission-create')
                <div class="dropdown">
                    <a class="avtar avtar-xs btn-link-secondary dropdown-toggle arrow-none" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons-two-tone f-18">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('permissions.create') }}">Thêm mới</a>
                    </div>
                </div>
                @endcan
            </div>
            <div class="card-body table-border-style">
                @livewire('permissions-table')
            </div>
        </div>
    </div>
</x-app-layout>