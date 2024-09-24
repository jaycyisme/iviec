<x-guest-layout>
    <x-authentication-card>
        <x-authentication-card-logo>
            <x-slot name="logoUrl">{{ asset('assets/images/authentication/img-auth-register.png') }}</x-slot>
            <x-slot name="title">Bảo mật hai lớp</x-slot>
        </x-authentication-card-logo>

        <div x-data="{ recovery: false }">
            <p class="mb-3" x-show="! recovery">Hãy nhập mã bảo mật hai lớp để tiến hành đăng nhập.</p>
            <p class="mb-3" x-cloak x-show="recovery">Hãy nhập một trong các mã khôi phục để có thể đăng nhập.</p>

            <x-validation-errors class="mb-3" />

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf
                <div class="mt-3" x-show="! recovery">
                    <x-label for="code" value="Mã bảo mật hai lớp" />
                    <x-input id="code" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                </div>

                <div class="mt-3" x-cloak x-show="recovery">
                    <x-label for="recovery_code" value="Mã khôi phục bảo mật hai lớp" />
                    <x-input id="recovery_code" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                </div>

                <div class="d-grid mt-3">
                    <x-button type="button" class="btn-secondary mb-3" x-show="! recovery" x-on:click="recovery = true; $nextTick(() => { $refs.recovery_code.focus() })">Sử dụng mã khôi phục</x-button>
                    <x-button type="button" class="btn-secondary mb-3" x-cloak x-show="recovery" x-on:click="recovery = false; $nextTick(() => { $refs.code.focus() })">Sử dụng mã bảo mật hai lớp</x-button>
                    <x-button class="btn-primary">
                        Tiến hành xác minh
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
