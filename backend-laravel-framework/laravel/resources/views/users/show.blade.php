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
                <h5>Tài khoản ID: {{ $user->id }}</h5>
                <a class="btn btn-lg btn-info" href="{{ route('users.index') }}">
                    Quay lại
                </a>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <x-label for="name" value="Tên hiển thị" />
                    <x-input type="text" id="name" name="name" value="{{ $user->name }}" readonly />
                </div>
                <div class="mb-3">
                    <x-label for="name" value="Địa chỉ Email" />
                    <x-input type="text" id="email" name="email" value="{{ $user->email }}" readonly />
                </div>
                <div class="mb-3 table-border-style">
                    <div class="table-responsive">
                        <x-label for="permission" value="Vai trò được cấp" />
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2">Tên vai trò</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userRole as $role)
                                <tr>
                                    <td class="align-middle" >
                                        <input name="role[{{ $role }}]" type="checkbox" value="{{ $role }}" checked disabled />
                                    </td>
                                    <td class="align-middle">{{ $role }}</td>
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

