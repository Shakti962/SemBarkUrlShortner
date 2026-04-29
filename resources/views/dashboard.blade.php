<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <p class="text-gray-500 text-sm">
            Welcome to your dashboard, {{ auth()->user()->name . '(' . auth()->user()->role . ')' }}
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (!auth()->user()->isSuperAdmin() && is_null(auth()->user()->company_id))
                <div class="overflow-x-auto bg-white shadow-xs rounded-base">
                    <div class="p-4">
                        <h3 class="text-lg text-[#6875F5] font-semibold">No company found.</h3>
                        <p class="text-gray-500 text-sm">Please contact admin to be assigned to a company and access to
                            content and features.</p>
                    </div>
                </div>
            @else
                <livewire:dashboard-data />
            @endif
        </div>
    </div>
</x-app-layout>