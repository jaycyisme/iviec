<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên vai trò</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td class="align-middle">{{ $role->name }}</td>
                <td class="align-middle">
                    <div class="d-flex align-items-center">
                        @can('role-list')
                            <div class="p-1 text-center">
                                <a class="btn btn-sm btn-warning wid-50" href="{{ route('roles.show', $role->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Xem">
                                    <i class="fas fa-file-alt"></i>
                                </a>
                            </div>
                        @endcan
                        @can('role-edit')
                        <div class="p-1 text-center">
                            <a class="btn btn-sm btn-info wid-50" href="{{ route('roles.edit', $role->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                        @endcan
                        @can('role-delete')
                        <div class="p-1 text-center">
                            <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
                                @csrf
                                <button class="btn btn-sm btn-danger wid-50" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </div>
                        @endcan
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $roles->onEachSide(2)->links() !!}
</div>