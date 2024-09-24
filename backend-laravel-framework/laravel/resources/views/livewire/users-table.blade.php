<div class="table-responsive">
    <div class="mb-3">
        <x-input type="text" id="search" name="search" wire:model.live="search" placeholder="Tìm kiếm..." />
    </div>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th></th>
                <th width="30%">Tên</th>
                <th width="30%">Email</th>
                <th>Vai trò</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr wire:key="{{ $user->id }}">
                <td class="align-middle text-center"><img class="rounded-circle img-fluid wid-60 img-thumbnail" src="@if(isset($user->profile_photo_path)){{ asset('storage/'.$user->profile_photo_path) }}@else{{ asset('assets/images/user/avatar-1.jpg') }}@endif" alt="{{ $user->name }}" /></td>
                <td class="align-middle">{{ $user->name }}</td>
                <td class="align-middle">{{ $user->email }}</td>
                <td class="align-middle text-center"><span class="badge text-bg-primary">{{ $user->roles->pluck('name')[0] ?? 'Thành viên' }}</span></td>
                <td class="align-middle">
                    <div class="d-flex align-items-center">
                        @can('users-list')
                        <div class="p-1 text-center">
                            <a class="btn btn-sm btn-warning wid-50" href="{{ route('users.show', $user->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Xem">
                                <i class="fas fa-file-alt"></i>
                            </a>
                        </div>
                        @endcan
                        @can('users-edit')
                        <div class="p-1 text-center">
                            <a class="btn btn-sm btn-info wid-50" href="{{ route('users.edit', $user->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                        @endcan
                        @can('users-delete')
                        <div class="p-1 text-center">
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}">
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
    {!! $users->onEachSide(2)->links() !!}
</div>