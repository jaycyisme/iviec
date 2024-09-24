<x-action-section>
    <x-slot name="title">
        Phiên đăng nhập
    </x-slot>

    <x-slot name="content">
        <x-action-message on="loggedOut">
            Hoàn tất!
        </x-action-message>
        @if (count($this->sessions) > 0)
            @foreach ($this->sessions as $session)
                <div class="row">
                    <div class="col-sm-6">
                        @if ($session->agent->isDesktop())
                            <i class="fas fa-desktop"></i>
                        @else
                            <i class="fas fa-mobile-alt"></i>
                        @endif
                    </div>

                    <div class="col-sm-6">
                        <div class="text-sm text-light">
                            {{ $session->agent->platform() ? $session->agent->platform() : __('Unknown') }} - {{ $session->agent->browser() ? $session->agent->browser() : __('Unknown') }}
                        </div>

                        <div>
                            <div class="text-xs text-light">
                                {{ $session->ip_address }},

                                @if ($session->is_current_device)
                                    <span class="text-green-500 font-semibold">Thiết bị này</span>
                                @else
                                    Lần cuối hoạt động: {{ $session->last_active }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="d-flex align-items-center mt-5">
            <x-button class="btn-danger" wire:click="confirmLogout" wire:loading.attr="disabled">
                Đăng xuất tất cả thiết bị
            </x-button>
        </div>

        <!-- Log Out Other Devices Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingLogout">
            <x-slot name="title">
                Đăng xuất toàn bộ thiết bị
            </x-slot>

            <x-slot name="content">
                <p>Để đảm bảo tính bảo mật, bạn vui lòng xác minh lại mật khẩu.</p>

                <div x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" placeholder="Mật khẩu..." autocomplete="current-password" x-ref="password" wire:model="password" wire:keydown.enter="logoutOtherBrowserSessions" />
                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button class="btn-danger" wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                    Hủy
                </x-secondary-button>

                <x-button class="btn-primary" wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                    Đăng xuất toàn bộ các thiết bị
                </x-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
