<x-app-layout>
    <x-slot name="pageHeader">
        Quản lý người dùng
    </x-slot>

    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="text-center mt-3">
                    <div class="chat-avtar d-inline-flex mx-auto">
                        <img class="rounded-circle img-fluid wid-90 img-thumbnail" src="@if(isset($user->profile_cover_path)){{ asset('storage/'.$user->profile_cover_path) }}@else{{ asset('assets/images/user/avatar-1.jpg') }}@endif" alt="{{ $user->name }}">
                    </div>
                    <h5 class="mb-0">{{ $user->name }}</h5>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h5>Chỉnh sửa người dùng ID: {{ $user->id }}</h5>
                <a class="btn btn-lg btn-info" href="{{ route('users.index') }}">
                    Quay lại
                </a>
            </div>
            <div class="card-body">
                <form class="form" method="POST" action="{{ route('users.edit', $user->id) }}">
                    @csrf
                    <div class="mb-3">
                        <x-label for="name" value="Tên hiển thị" />
                        <x-input type="text" id="name" name="name" value="{{ $user->name }}" />
                    </div>
                    <div class="mb-3">
                        <x-label for="name" value="Địa chỉ Email" />
                        <x-input type="text" id="email" name="email" value="{{ $user->email }}" />
                    </div>
                    <div class="mb-3">
                        <x-label for="permission" value="Vai trò" />
                        <select class="form-select" id="role" name="role">
                            @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ in_array($role->name, $userRole) ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <x-button class="btn-primary" type="submit">Hoàn tất chỉnh sửa</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>