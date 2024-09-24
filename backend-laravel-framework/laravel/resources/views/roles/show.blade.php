<x-app-layout>
    <x-slot name="pageHeader">
        Quản lý vai trò
    </x-slot>

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h5>Xem vai trò ID: {{ $role->id }}</h5>
                <a class="btn btn-lg btn-info" href="{{ route('roles.index') }}">
                    Quay lại
                </a>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <x-label for="name" value="Tên vai trò" />
                    <x-input type="text" readonly value="{{ $role->name }}" />
                </div>
                <div class="mb-3 table-border-style">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Tên quyền</th>
                                    <th>Guard</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rolePermissions as $permission)
                                    <tr>
                                        <td class="align-middle">
                                            <input name="permission[{{ $permission->name }}]" type="checkbox" value="{{ $permission->name }}" checked disabled>
                                        </td>
                                        <td class="align-middle">{{ $permission->name }}</td>
                                        <td class="align-middle">{{ $permission->guard_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>