<div class="table-responsive">
    <div class="mb-3">
        <x-input type="text" id="search" name="search" wire:model.live="search" placeholder="Tìm kiếm..." />
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên quyền</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
            <tr>
                <td class="align-middle">{{ $permission->name }}</td>
                <td class="align-middle">{{ $permission->guard_name }}</td>
                <td class="align-middle">
                    <div class="d-flex align-items-center">
                        @can('permission-edit')
                        <div class="p-1 text-center">
                            <a class="btn btn-sm btn-info wid-50" href="{{ route('permissions.edit', $permission->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                        @endcan
                        @can('permission-delete')
                        <div class="p-1 text-center">
                            <form method="POST" action="{{ route('permissions.destroy', $permission->id) }}">
                                @csrf
                                <button class="btn btn-sm btn-danger wid-50" type="submit"><i class="fas fa-times"></i></button>
                            </form>
                        </div>
                        @endcan
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $permissions->onEachSide(2)->links() !!}
</div>