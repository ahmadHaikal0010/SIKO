<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                {{-- Dashboard --}}
                <a href="{{ route('tenant.dashboard') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium
                          bg-[#406f6b] text-white hover:bg-[#254846] transition">
                    <span class="text-base">←</span>
                    <span>Dashboard</span>
                </a>

                {{-- Brand --}}
                <span class="text-lg font-semibold text-gray-900">
                    SIKO Penghuni
                </span>
            </div>

            <div class="flex items-center gap-3">
                <span class="hidden sm:inline text-sm text-gray-600">
                    {{ Auth::user()->name }}
                </span>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                                   bg-[#406f6b] text-white hover:bg-[#254846] transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
