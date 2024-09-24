<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        Thông tin tài khoản
    </x-slot>

    <x-slot name="actionnotification">
        <x-action-message on="saved" class="">
            Đã lưu!
        </x-action-message>
    </x-slot>

    <x-slot name="form">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <x-label for="photo" value="Ảnh đại diện" />
        <x-input-error for="photo" />

        <div class="row" x-data="{photoName: null, photoPreview: null}">
            <div class="col-6">
                <div x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-circle wid-90 img-fluid img-thumbnail" style="width:128px; height:128px; background-position: center; background-size: cover;">
                </div>
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <img class="rounded-circle img-fluid wid-90 img-thumbnail" x-bind:style="'background-image: url(\'' + photoPreview + '\'); width:128px; height:128px; background-position: center; background-size: cover;'">
                </div>
            </div>
            <div class="col-6">
                <input type="file" class="d-none" id="photo" wire:model.live="photo"
                    x-ref="photo"
                    x-on:change="
                        photoName = $refs.photo.files[0].name;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            photoPreview = e.target.result;
                        };
                        reader.readAsDataURL($refs.photo.files[0]);
                    " />
                <div class="row align-items-center" style="height: 128px;">
                    <div class="col text-center">
                        <x-secondary-button type="button" class="btn-secondary" x-on:click.prevent="$refs.photo.click()">
                            Tải ảnh đại diện
                        </x-secondary-button>
                    </div>
                    @if ($this->user->profile_photo_path)
                    <div class="col text-center">
                        <x-secondary-button type="button" class="btn-danger" wire:click="deleteProfilePhoto">
                            Xóa ảnh đại diện
                        </x-secondary-button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
        <div class="row mt-3">
            <x-input-error for="name"/>
            <x-label for="name" value="Tên hiển thị" />
            <x-input id="name" type="text" wire:model="state.name" required autocomplete="name" />
        </div>
        <div class="row mt-3">
            <x-input-error for="email" />
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <div class="alert alert-warning mb-3" role="alert">
                    <p>Địa chỉ email chưa được kích hoạt.</p>
                    <button type="button" class="btn btn-primary btn-sm" wire:click.prevent="sendEmailVerification">
                        Bấm vào đây để hệ thống gửi lại đường dẫn kích hoạt địa chỉ Email!
                    </button>
                </div>
                @if ($this->verificationLinkSent)
                <div class="alert alert-info alert-dismissible fade show mb-3" role="alert">
                    <strong>Gửi lại thành công!</strong> Hệ thống vừa gửi cho bạn một thư điện có chứa đường dẫn kích hoạt địa chỉ email.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                </div>
                @endif
            @endif
            <x-label for="email" value="Địa chỉ Email" />
            <x-input id="email" type="email" wire:model="state.email" required autocomplete="email" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button class="btn-success" wire:loading.attr="disabled" wire:target="photo">
            Lưu thông tin
        </x-button>
    </x-slot>
</x-form-section>
