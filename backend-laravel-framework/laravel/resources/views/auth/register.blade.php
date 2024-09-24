<x-guest-layout>
    <x-authentication-card>
        <x-authentication-card-logo>
            <x-slot name="logoUrl">{{ asset('assets/images/authentication/img-auth-login.png') }}</x-slot>
            <x-slot name="title">Đăng ký</x-slot>
        </x-authentication-card-logo>

        <x-validation-errors class="mb-3" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <x-label for="name" value="Tên hiển thị" />
                <x-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-3">
                <x-label for="email" value="Địa chỉ Email" />
                <x-input id="email" type="email" name="email" :value="old('email')" required autocomplete="email" />
            </div>

            <div class="mt-3">
                <x-label for="password" value="Mật khẩu" />
                <x-input id="password" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-3">
                <x-label for="password_confirmation" value="Xác nhận Mật khẩu" />
                <x-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-3">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="mt-3">
                <a href="{{ route('login') }}">Đã đăng ký?</a>
            </div>

            <div class="d-grid mt-3">
                <x-button class="btn-primary">
                    Đăng ký
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
