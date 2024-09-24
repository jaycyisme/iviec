<x-app-layout>
    <x-slot name="pageHeader">
        Hồ sơ cá nhân
    </x-slot>

    <div class="col-lg-6">
        <div class="card">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
            @endif
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                @livewire('profile.update-password-form')
            @endif
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                @livewire('profile.two-factor-authentication-form')
            @endif
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>
    </div>
    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
    <div class="col-lg-12">
        <div class="card">
        @livewire('profile.delete-user-form')
        </div>
    </div>
    @endif
</x-app-layout>
