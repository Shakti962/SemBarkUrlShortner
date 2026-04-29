<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Invite') }}
        </h2>
        <p class="text-gray-500 text-sm">
            Welcome to your dashboard, {{ auth()->user()->name . '(' . auth()->user()->role . ')' }}
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:manage-invite />
        </div>
    </div>
</x-app-layout>