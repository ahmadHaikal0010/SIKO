<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profile') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                Kelola informasi akun, keamanan, dan penghapusan akun.
            </p>
        </div>
    </x-slot>

    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
        <div class="px-6 py-5 bg-[#315e5b]">
            <h3 class="text-white font-semibold text-lg">Pengaturan Akun</h3>
            <p class="text-white/85 text-sm mt-1">Perbarui data akun dan keamanan Anda.</p>
        </div>

        <div class="p-6 space-y-6 bg-[#f9fdfd]">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                <div class="p-6">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                <div class="p-6">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-red-200">
                <div class="p-6">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
