<x-guest-layout>
    <x-authentication-card>
        <x-authentication-card-logo>
            <x-slot name="logoUrl">{{ asset('assets/images/authentication/img-auth-login.png') }}</x-slot>
            <x-slot name="title">Đăng nhập</x-slot>
        </x-authentication-card-logo>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="alert alert-success" role="alert">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <x-label for="email" value="Địa chỉ Email" />
                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
            </div>

            <div class="mb-3">
                <x-label for="password" value="Mật khẩu" />
                <x-input id="password" type="password" name="password" required autocomplete="current-password" />
            </div>

            {{-- <div class="mb-3">
                <x-label for="token" value="Token" />
                <x-input type="text" id="token" type="text" name="token" value="{{ $token }}" autocomplete="off" />
            </div> --}}

            <div class="mb-3 form-check">
                <x-label for="remember_me" value="Ghi nhớ" />
                <x-checkbox id="remember_me" name="remember" />
            </div>

            <div class="d-grid mt-4">
                <x-button class="btn-primary">
                    Đăng nhập
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
