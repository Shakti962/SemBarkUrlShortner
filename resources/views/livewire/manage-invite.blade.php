<div>
    @unless (auth()->user()->isMember())
        <div class="overflow-x-auto bg-white shadow-xs rounded-base border border-default mb-4">
            <div class="pt-4 px-4 flex items-center justify-between space-x-4">
                <h3 class="text-lg text-[#6875F5] font-semibold">Invite New Member</h3>
            </div>
            <div class="pt-2 p-4 grid grid-cols-3 gap-x-4">
                <div>
                    <select wire:model="company" name="company" id="company"
                        class="mt-1 p-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                    @error('company')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <x-input id="email" wire:model="email" class="block mt-1 w-full" type="email" name="email"
                        placeholder="user@example.com" required />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <select wire:model="role" name="role" id="role"
                        class="mt-1 p-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        <option value="member" selected>Member</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-button wire:click="invite()" class="bg-[#6875F5] px-8">Invite</x-button>
                </div>
            </div>
        </div>
    @endunless
    @unless(auth()->user()->isSuperAdmin())
        <div class="overflow-x-auto bg-white shadow-xs rounded-base border border-default">
            <div class="p-4 flex items-center justify-between space-x-4">
                <h3 class="text-lg text-[#6875F5] font-semibold">
                    Invitations
                </h3>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-body">
                <thead class="text-sm font-bold border-b border-t border-default-medium">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Sender
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Company
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Role
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($invites as $invite)
                        <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                            <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                {{ $invite->sendBy->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $invite->company->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $invite->role }}
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="reject({{ $invite->id }})" onclick="return confirm('Are you sure?')"
                                    class="py-1 px-4 text-white bg-red-500 rounded">Reject</button>
                                <button wire:click="accept({{ $invite->id }})"
                                    onclick="return confirm('Are you sure you want to accept? You will be removed from your current company.')"
                                    class="py-1 px-4 text-white bg-blue-500 rounded">Accept</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center">
                                No invitation found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endunless
</div>