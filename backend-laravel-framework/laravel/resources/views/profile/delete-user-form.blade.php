<x-action-section>
    <x-slot name="title">
        Xóa tài khoản
    </x-slot>

    <x-slot name="content">
        <p>
            Một khi đã xóa tài khoản, tất cả dữ liệu liên quan đến tài khoản này đều sẽ bị xóa sạch. Hãy suy nghĩ kỹ trước khi thực hiện.
        </p>

        <x-danger-button class="btn-danger" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
            Xóa tài khoản
        </x-danger-button>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                Xóa tài khoản
            </x-slot>

            <x-slot name="content">
                <p>Để đảm bảo tính bảo mật, bạn vui lòng xác minh lại mật khẩu.</p>

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" autocomplete="current-password" placeholder="Mật khẩu..." x-ref="password" wire:model="password" wire:keydown.enter="deleteUser" />
                    <x-input-error for="password" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button class="btn-secondary" wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    Hủy
                </x-secondary-button>

                <x-danger-button class="btn-danger" wire:click="deleteUser" wire:loading.attr="disabled">
                    Xóa tài khoản
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
