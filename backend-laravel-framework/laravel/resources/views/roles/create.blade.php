<x-app-layout>
    <x-slot name="pageHeader">
        Quản lý vai trò
    </x-slot>

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h5>Tạo vai trò mới</h5>
                <a class="btn btn-lg btn-info" href="{{ route('roles.index') }}">
                    Quay lại
                </a>
            </div>
            <div class="card-body">
                <form class="form" method="POST" action="{{ route('roles.create') }}">
                    @csrf
                    <div class="mb-3">
                        <x-label for="name" value="Tên vai trò" />
                        <x-input type="text" id="name" name="name" placeholder="Tên vai trò..." require />
                        <x-input-error for="name" />
                    </div>
                    <div class="mb-3 table-border-style">
                        <div class="table-responsive">
                            <x-label for="permission" value="Bảng quyền hạn" />
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tên quyền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permissions as $permission)
                                    <tr>
                                        <td class="align-middle" >
                                            <input name="permission[{{ $permission->name }}]" type="checkbox" value="{{ $permission->name }}" />
                                        </td>
                                        <td class="align-middle">{{ $permission->name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <x-input-error for="permission" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <x-button class="btn-primary">Tạo vai trò</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>