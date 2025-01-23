<x-app-layout :title="$title">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1>{{ __('Profile') }}</h1>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                @include('profile.partials.update-profile-information-form')
            </div>
            <div class="col-12">
                @include('profile.partials.update-password-form')
            </div>
            <div class="col-12 mt-3">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
