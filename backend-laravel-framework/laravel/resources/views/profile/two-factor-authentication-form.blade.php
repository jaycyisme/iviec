<x-action-section>
    <x-slot name="title">
        Bảo mật hai lớp
    </x-slot>

    <x-slot name="content">
        <div class="row">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    <div class="alert alert-warning" role="alert">Bạn cần hoàn tất cài đặt bảo mật hai lớp.</div>
                @else
                    <div class="alert alert-success" role="alert">Bảo mật hai lớp đã được kích hoạt.</div>
                @endif
            @else
                <div class="alert alert-danger" role="alert">Bảo mật hai lớp chưa được kích hoạt, hãy kích hoạt để bảo vệ tài khoản của mình.</div>
            @endif
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <p style="text-align: justify;">
                        @if ($showingConfirmation)
                            Để hoàn tất cài đặt bảo mật hai lớp, hãy quét mã QR trên màn hình bằng ứng dụng Authenticator hoặc nhập tay mã khóa và cung cấp OTP hiển thị trên ứng dụng Authenticator.
                        @else
                            Bảo mật hai lớp đã được bật. Hãy quét mã QR trên màn hình bằng ứng dụng Authenticator hoặc nhập tay mã khóa.
                        @endif
                        </p>
                    </div>
                    <div class="col-lg-6 text-center">
                        {!! $this->user->twoFactorQrCodeSvg() !!}
                        <p class="mt-5">Mã khóa: {{ decrypt($this->user->two_factor_secret) }}</p>
                    </div>
                </div>

                @if ($showingConfirmation)
                    <div class="row mt-3">
                        <x-label for="code" value="Mã OTP" />
                        <x-input id="code" type="text" name="code" inputmode="numeric" autofocus autocomplete="one-time-code" wire:model="code" wire:keydown.enter="confirmTwoFactorAuthentication" />
                        <x-input-error for="code" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="row mt-3">
                    <div class="col-12">
                        <p>Hãy giữ lại cẩn thận những mã này, khi bạn không còn giữ mã OTP trong ứng dụng Authenticator, bạn có thể sử dụng những mã này để truy cập.</p>
                    </div>
                    <div class="col-12">
                        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                            <p><strong>{{ $code }}</strong></p>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif

        <div class="row mt-3">
            @if (! $this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-button type="button" class="btn-primary" wire:loading.attr="disabled">
                        Kích hoạt
                    </x-button>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <div class="col-6 text-center">
                        <x-confirms-password wire:then="regenerateRecoveryCodes">
                            <x-secondary-button class="btn-info">
                                Tạo lại mã khôi phục
                            </x-secondary-button>
                        </x-confirms-password>
                    </div>
                @elseif ($showingConfirmation)
                    <div class="col-6 text-center">
                        <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                            <x-button type="button" class="btn-primary" wire:loading.attr="disabled">
                                Xác nhận
                            </x-button>
                        </x-confirms-password>
                    </div>
                @else
                    <div class="col-6 text-center">
                        <x-confirms-password wire:then="showRecoveryCodes">
                            <x-secondary-button class="btn-info">
                                Hiển thị mã khôi phục
                            </x-secondary-button>
                        </x-confirms-password>
                    </div>
                @endif

                @if ($showingConfirmation)
                    <div class="col-6 text-center">
                        <x-confirms-password wire:then="disableTwoFactorAuthentication">
                            <x-secondary-button class="btn-danger" wire:loading.attr="disabled">
                                Hủy
                            </x-secondary-button>
                        </x-confirms-password>
                    </div>
                @else
                    <div class="col-6 text-center">
                        <x-confirms-password wire:then="disableTwoFactorAuthentication">
                            <x-danger-button class="btn-danger" wire:loading.attr="disabled">
                                Tắt bảo mật hai lớp
                            </x-danger-button>
                        </x-confirms-password>
                    </div>
                @endif
            @endif
        </div>
    </x-slot>
</x-action-section>